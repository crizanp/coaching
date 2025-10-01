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
        // SQLite doesn't support MODIFY COLUMN
        // For SQLite, we'll just ensure the values are valid in the application logic
        // The enum constraints will be enforced by the Event model
        
        // For MySQL, you can uncomment these lines:
        // DB::statement("ALTER TABLE events MODIFY COLUMN type ENUM('workshop', 'practical', 'online', 'hybrid') DEFAULT 'workshop'");
        // DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('draft', 'upcoming', 'active', 'completed', 'cancelled') DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enums
        DB::statement("ALTER TABLE events MODIFY COLUMN type ENUM('practical', 'workshop') DEFAULT 'workshop'");
        DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('active', 'upcoming', 'completed', 'cancelled') DEFAULT 'upcoming'");
    }
};
