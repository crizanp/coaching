<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CheckEventData extends Command
{
    protected $signature = 'check:event-data';
    protected $description = 'Check event data in SQLite database';

    public function handle()
    {
        $this->info('Checking event data in SQLite...');

        // Configure SQLite connection
        Config::set('database.connections.sqlite_source', [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        $sqliteConnection = DB::connection('sqlite_source');

        try {
            $eventsCount = $sqliteConnection->table('events')->count();
            $eventApplicationsCount = $sqliteConnection->table('event_applications')->count();
            
            $this->info("SQLite Events: {$eventsCount}");
            $this->info("SQLite Event Applications: {$eventApplicationsCount}");

            if ($eventsCount > 0) {
                $events = $sqliteConnection->table('events')->get();
                foreach ($events as $event) {
                    $this->info("Event ID: {$event->id}, Title: {$event->title}");
                }
            }

        } catch (\Exception $e) {
            $this->error("Error checking event data: " . $e->getMessage());
        }
    }
}
