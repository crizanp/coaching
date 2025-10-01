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
        // For SQLite, we need to recreate the table to properly remove columns and indexes
        Schema::rename('event_applications', 'event_applications_old');
        
        Schema::create('event_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->timestamps();
            
            $table->index('event_id');
            $table->index('status');
            $table->index('email');
        });
        
        // Copy data from old table to new table
        DB::statement('INSERT INTO event_applications (id, event_id, name, email, phone, company, message, status, notes, ip_address, confirmed_at, status_updated_at, created_at, updated_at)
            SELECT id, event_id, name, email, phone, company, message, status, notes, ip_address, confirmed_at, status_updated_at, created_at, updated_at
            FROM event_applications_old'
        );
        
        // Drop old table
        Schema::dropIfExists('event_applications_old');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a destructive operation, so we'll keep it simple
        Schema::dropIfExists('event_applications');
    }
};
