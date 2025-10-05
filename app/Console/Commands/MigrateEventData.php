<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Event;
use App\Models\EventApplication;

class MigrateEventData extends Command
{
    protected $signature = 'migrate:event-data';
    protected $description = 'Migrate event data from SQLite to MySQL';

    public function handle()
    {
        $this->info('Starting event data migration from SQLite to MySQL...');

        // Create SQLite connection
        Config::set('database.connections.sqlite_source', [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        $sqliteConnection = DB::connection('sqlite_source');

        // Migrate events
        $this->migrateEvents($sqliteConnection);
        
        // Migrate event applications
        $this->migrateEventApplications($sqliteConnection);

        $this->info('Event data migration completed!');
    }

    private function migrateEvents($sqliteConnection)
    {
        $this->info('Migrating events...');

        try {
            $events = $sqliteConnection->table('events')->get();
            
            if ($events->isEmpty()) {
                $this->warn('No events found');
                return;
            }

            foreach ($events as $event) {
                $eventArray = (array) $event;
                
                // Handle timestamps
                if (isset($eventArray['created_at'])) {
                    $eventArray['created_at'] = $eventArray['created_at'] ? date('Y-m-d H:i:s', strtotime($eventArray['created_at'])) : null;
                }
                if (isset($eventArray['updated_at'])) {
                    $eventArray['updated_at'] = $eventArray['updated_at'] ? date('Y-m-d H:i:s', strtotime($eventArray['updated_at'])) : null;
                }

                // Create event
                $model = new Event();
                $model->fill($eventArray);
                $model->save();
            }

            $this->info("Migrated {$events->count()} events");

        } catch (\Exception $e) {
            $this->error("Error migrating events: " . $e->getMessage());
        }
    }

    private function migrateEventApplications($sqliteConnection)
    {
        $this->info('Migrating event applications...');

        try {
            $applications = $sqliteConnection->table('event_applications')->get();
            
            if ($applications->isEmpty()) {
                $this->warn('No event applications found');
                return;
            }

            foreach ($applications as $application) {
                $applicationArray = (array) $application;
                
                // Handle timestamps
                if (isset($applicationArray['created_at'])) {
                    $applicationArray['created_at'] = $applicationArray['created_at'] ? date('Y-m-d H:i:s', strtotime($applicationArray['created_at'])) : null;
                }
                if (isset($applicationArray['updated_at'])) {
                    $applicationArray['updated_at'] = $applicationArray['updated_at'] ? date('Y-m-d H:i:s', strtotime($applicationArray['updated_at'])) : null;
                }

                // Create event application
                $model = new EventApplication();
                $model->fill($applicationArray);
                $model->save();
            }

            $this->info("Migrated {$applications->count()} event applications");

        } catch (\Exception $e) {
            $this->error("Error migrating event applications: " . $e->getMessage());
        }
    }
}
