<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if new columns already exist before adding them
        if (!Schema::hasColumn('event_applications', 'name')) {
            Schema::table('event_applications', function (Blueprint $table) {
                $table->string('name')->nullable()->after('event_id');
                $table->string('email')->nullable()->after('name');
                $table->string('phone')->nullable()->after('email');
                $table->string('company')->nullable()->after('phone');
                $table->text('message')->nullable()->after('company');
                $table->string('ip_address')->nullable()->after('message');
                $table->timestamp('confirmed_at')->nullable()->after('ip_address');
                $table->timestamp('status_updated_at')->nullable()->after('confirmed_at');
            });
        }

        // Copy data from old columns to new columns if old columns exist
        if (Schema::hasColumn('event_applications', 'applicant_name')) {
            DB::statement('UPDATE event_applications SET 
                name = applicant_name,
                email = applicant_email,
                phone = applicant_phone,
                message = motivation,
                status_updated_at = processed_at
            ');

            // Update status values to match new system
            DB::statement("UPDATE event_applications SET status = 'confirmed' WHERE status = 'approved'");
            DB::statement("UPDATE event_applications SET status = 'cancelled' WHERE status = 'rejected'");

            // Remove old columns
            Schema::table('event_applications', function (Blueprint $table) {
                $table->dropColumn([
                    'applicant_name',
                    'applicant_email', 
                    'applicant_phone',
                    'applicant_age',
                    'motivation',
                    'special_requirements',
                    'applied_at',
                    'processed_at'
                ]);
            });
        }

        // Update status enum to include new values (SQLite doesn't support MODIFY COLUMN)
        // For SQLite, we'll just ensure the values are valid in the application logic
        // The enum constraint will be enforced by the EventApplication model
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        Schema::table('event_applications', function (Blueprint $table) {
            // Add back old columns
            $table->string('applicant_name')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_phone')->nullable();
            $table->string('applicant_age')->nullable();
            $table->text('motivation')->nullable();
            $table->text('special_requirements')->nullable();
            $table->timestamp('applied_at')->nullable();
            $table->timestamp('processed_at')->nullable();
        });

        // Copy data back
        DB::statement('UPDATE event_applications SET 
            applicant_name = name,
            applicant_email = email,
            applicant_phone = phone,
            motivation = message,
            processed_at = status_updated_at,
            applied_at = created_at
        ');

        // Revert status changes
        DB::statement("UPDATE event_applications SET status = 'approved' WHERE status = 'confirmed'");
        DB::statement("UPDATE event_applications SET status = 'rejected' WHERE status = 'cancelled'");

        // Remove new columns
        Schema::table('event_applications', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'phone',
                'company',
                'message',
                'ip_address',
                'confirmed_at',
                'status_updated_at'
            ]);
        });

        // Revert status enum
        DB::statement("ALTER TABLE event_applications MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'cancelled') DEFAULT 'pending'");
    }
};
