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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->after('preferred_language');
            $table->index(['service_id', 'ip_address', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex(['service_id', 'ip_address', 'status']);
            $table->dropColumn('ip_address');
        });
    }
};
