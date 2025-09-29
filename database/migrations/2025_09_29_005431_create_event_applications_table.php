<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone')->nullable();
            $table->string('applicant_age')->nullable();
            $table->text('motivation')->nullable(); // Why they want to participate
            $table->text('special_requirements')->nullable(); // Special needs, diet, etc.
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('notes')->nullable(); // Admin notes
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            
            $table->index('event_id');
            $table->index('status');
            $table->index('applicant_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_applications');
    }
};
