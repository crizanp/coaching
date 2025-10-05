<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Event;
use App\Models\EventApplication;

class MigrateSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:sqlite-to-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from SQLite to MySQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration from SQLite to MySQL...');

        // Create SQLite connection
        $sqliteConnection = $this->createSqliteConnection();

        // Migrate each table
        $this->migrateTable($sqliteConnection, 'users', User::class);
        $this->migrateTable($sqliteConnection, 'services', Service::class);
        $this->migrateTable($sqliteConnection, 'appointments', Appointment::class);
        $this->migrateTable($sqliteConnection, 'blogs', Blog::class);
        $this->migrateTable($sqliteConnection, 'testimonials', Testimonial::class);
        $this->migrateTable($sqliteConnection, 'pages', Page::class);
        $this->migrateTable($sqliteConnection, 'settings', Setting::class);
        $this->migrateTable($sqliteConnection, 'events', Event::class);
        $this->migrateTable($sqliteConnection, 'event_applications', EventApplication::class);

        $this->info('Migration completed successfully!');
    }

    private function createSqliteConnection()
    {
        Config::set('database.connections.sqlite_source', [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        return DB::connection('sqlite_source');
    }

    private function migrateTable($sqliteConnection, $tableName, $modelClass)
    {
        $this->info("Migrating {$tableName}...");

        try {
            // Get data from SQLite
            $data = $sqliteConnection->table($tableName)->get();
            
            if ($data->isEmpty()) {
                $this->warn("No data found in {$tableName}");
                return;
            }

            // Insert data into MySQL
            foreach ($data as $record) {
                $recordArray = (array) $record;
                
                // Handle timestamps properly
                if (isset($recordArray['created_at'])) {
                    $recordArray['created_at'] = $recordArray['created_at'] ? date('Y-m-d H:i:s', strtotime($recordArray['created_at'])) : null;
                }
                if (isset($recordArray['updated_at'])) {
                    $recordArray['updated_at'] = $recordArray['updated_at'] ? date('Y-m-d H:i:s', strtotime($recordArray['updated_at'])) : null;
                }

                // Use model to create record (this handles fillable attributes properly)
                $model = new $modelClass();
                $model->fill($recordArray);
                $model->save();
            }

            $this->info("Migrated {$data->count()} records from {$tableName}");

        } catch (\Exception $e) {
            $this->error("Error migrating {$tableName}: " . $e->getMessage());
        }
    }
}
