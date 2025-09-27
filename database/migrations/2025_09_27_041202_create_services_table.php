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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // {"fr": "Sophrologie", "en": "Sophrology"}
            $table->json('description'); // Short description for listing
            $table->json('content'); // Full content for detail page
            $table->string('slug')->unique();
            $table->json('benefits')->nullable(); // Array of benefits
            $table->json('session_format')->nullable(); // Session details
            $table->decimal('price_individual', 8, 2)->nullable();
            $table->decimal('price_group', 8, 2)->nullable();
            $table->string('duration')->nullable(); // "60 minutes"
            $table->string('icon')->nullable(); // Icon class or image
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
