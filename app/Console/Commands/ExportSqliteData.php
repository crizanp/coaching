<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExportSqliteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:sqlite-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export data from SQLite database to MySQL-compatible SQL file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Temporarily switch to SQLite for export
        config(['database.default' => 'sqlite']);
        
        // Reconnect to ensure we're using SQLite
        DB::purge('sqlite');
        DB::reconnect('sqlite');
        
        $this->info('Starting SQLite data export...');
        
        // List of tables to export (excluding Laravel system tables)
        $tablesToExport = [
            'users',
            'appointments', 
            'blogs',
            'blog_reactions',
            'blog_gift_requests',
            'events',
            'event_applications',
            'guides',
            'guide_downloads',
            'media',
            'pages',
            'services',
            'settings',
            'testimonials'
        ];

        $sqlOutput = "-- SQLite to MySQL Data Export\n";
        $sqlOutput .= "-- Generated on " . date('Y-m-d H:i:s') . "\n\n";

        foreach ($tablesToExport as $table) {
            try {
                $this->info("Exporting table: $table");
                
                // Check if table exists
                if (!Schema::connection('sqlite')->hasTable($table)) {
                    $this->warn("  - Table $table does not exist, skipping");
                    continue;
                }
                
                // Check if table has data
                $count = DB::connection('sqlite')->table($table)->count();
                $this->info("  - Found $count records");
                
                if ($count > 0) {
                    $sqlOutput .= "-- Data for table '$table'\n";
                    
                    // Get all records
                    $records = DB::connection('sqlite')->table($table)->get();
                    
                    foreach ($records as $record) {
                        $record = (array) $record;
                        
                        // Prepare column names and values
                        $columns = array_keys($record);
                        $values = array_values($record);
                        
                        // Escape values for MySQL
                        $escapedValues = array_map(function($value) {
                            if ($value === null) {
                                return 'NULL';
                            } elseif (is_string($value)) {
                                return "'" . addslashes($value) . "'";
                            } elseif (is_bool($value)) {
                                return $value ? '1' : '0';
                            } else {
                                return $value;
                            }
                        }, $values);
                        
                        $columnsList = '`' . implode('`, `', $columns) . '`';
                        $valuesList = implode(', ', $escapedValues);
                        
                        $sqlOutput .= "INSERT INTO `$table` ($columnsList) VALUES ($valuesList);\n";
                    }
                    
                    $sqlOutput .= "\n";
                }
                
            } catch (\Exception $e) {
                $this->error("  - Error exporting $table: " . $e->getMessage());
            }
        }

        // Save to file
        $filename = base_path('sqlite_data_export.sql');
        file_put_contents($filename, $sqlOutput);

        $this->info("\nExport completed! Data saved to: $filename");
        $filesize = filesize($filename);
        $this->info("Total file size: " . $this->formatBytes($filesize));
        
        return 0;
    }
    
    private function formatBytes($size, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}
