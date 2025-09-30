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
        Schema::table('guide_downloads', function (Blueprint $table) {
            $table->string('guide_slug')->after('ip_address')->nullable();
            $table->index(['ip_address', 'guide_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guide_downloads', function (Blueprint $table) {
            $table->dropIndex(['ip_address', 'guide_slug']);
            $table->dropColumn('guide_slug');
        });
    }
};
