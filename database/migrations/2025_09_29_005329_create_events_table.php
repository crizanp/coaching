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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // {"fr": "Titre français", "en": "English title"}
            $table->string('slug')->unique();
            $table->json('description'); // Short description for listing
            $table->json('content'); // Full content with details
            $table->enum('type', ['practical', 'workshop']); // practical information or workshop
            $table->enum('status', ['active', 'upcoming', 'completed', 'cancelled'])->default('upcoming');
            $table->string('featured_image')->nullable(); // Main event image
            $table->json('gallery')->nullable(); // Array of additional images/graphics
            $table->decimal('price', 8, 2)->nullable(); // Event price
            $table->string('duration')->nullable(); // Duration (e.g., "2 hours", "1 day")
            $table->integer('max_participants')->nullable(); // Maximum number of participants
            $table->integer('current_participants')->default(0); // Current registrations
            $table->dateTime('event_date')->nullable(); // When the event takes place
            $table->dateTime('registration_deadline')->nullable(); // When registration closes
            $table->json('location')->nullable(); // {"address": "...", "city": "...", "type": "online/offline"}
            $table->json('requirements')->nullable(); // What participants need to bring/know
            $table->json('benefits')->nullable(); // Array of event benefits
            $table->json('program')->nullable(); // Event program/schedule
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('allow_registration')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('status');
            $table->index('event_date');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
