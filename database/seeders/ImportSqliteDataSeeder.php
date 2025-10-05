<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportSqliteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting SQLite data import...');
        
        // Check if the export file exists
        $exportFile = base_path('sqlite_data_export.sql');
        
        if (!File::exists($exportFile)) {
            $this->command->error("Export file not found: $exportFile");
            $this->command->error("Please run the export command first: php artisan export:sqlite-data");
            return;
        }
        
        $this->command->info("Reading export file: $exportFile");
        
        // Read the SQL file
        $sql = File::get($exportFile);
        
        // Split into individual statements
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($statement) {
                return !empty($statement) && !str_starts_with($statement, '--');
            }
        );
        
        $this->command->info("Found " . count($statements) . " SQL statements to execute");
        
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        $successCount = 0;
        $errorCount = 0;
        
        foreach ($statements as $statement) {
            try {
                DB::statement($statement);
                $successCount++;
                
                // Extract table name for progress display
                if (preg_match('/INSERT INTO `(\w+)`/', $statement, $matches)) {
                    $tableName = $matches[1];
                    $this->command->line("  ✓ Imported record to $tableName");
                }
                
            } catch (\Exception $e) {
                $errorCount++;
                $this->command->error("  ✗ Failed to execute statement: " . substr($statement, 0, 100) . "...");
                $this->command->error("    Error: " . $e->getMessage());
            }
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $this->command->info("\n" . str_repeat('=', 50));
        $this->command->info("Import Summary:");
        $this->command->info("✓ Successful imports: $successCount");
        if ($errorCount > 0) {
            $this->command->warn("✗ Failed imports: $errorCount");
        }
        $this->command->info(str_repeat('=', 50));
        
        if ($errorCount === 0) {
            $this->command->info("🎉 All data imported successfully!");
        } else {
            $this->command->warn("⚠️ Some imports failed. Check the errors above.");
        }
        
        // Display summary of imported data
        $this->displayDataSummary();
    }
    
    private function displayDataSummary(): void
    {
        $this->command->info("\nData Summary:");
        
        $tables = [
            'users' => 'Users',
            'appointments' => 'Appointments',
            'blogs' => 'Blog Posts',
            'blog_reactions' => 'Blog Reactions',
            'blog_gift_requests' => 'Blog Gift Requests',
            'events' => 'Events',
            'event_applications' => 'Event Applications',
            'guides' => 'Guides',
            'guide_downloads' => 'Guide Downloads',
            'media' => 'Media Files',
            'pages' => 'Pages',
            'services' => 'Services',
            'settings' => 'Settings',
            'testimonials' => 'Testimonials'
        ];
        
        foreach ($tables as $table => $label) {
            try {
                $count = DB::table($table)->count();
                $this->command->line("  $label: $count records");
            } catch (\Exception $e) {
                $this->command->line("  $label: Error reading table");
            }
        }
    }
}
