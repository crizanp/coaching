<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class FixEventArrayFields extends Command
{
    protected $signature = 'fix:event-array-fields';
    protected $description = 'Fix all event array fields that were stored as string instead of array';

    public function handle()
    {
        $this->info('Fixing event array fields...');

        $events = Event::all();
        $fixed = 0;
        $arrayFields = ['gallery', 'location', 'requirements', 'benefits', 'program'];

        foreach ($events as $event) {
            $needsSave = false;

            foreach ($arrayFields as $field) {
                $rawValue = $event->getAttributes()[$field] ?? null;
                
                if (is_string($rawValue) && !empty($rawValue)) {
                    // Try to decode JSON string first
                    $decoded = json_decode($rawValue, true);
                    
                    if (is_array($decoded)) {
                        $event->$field = $decoded;
                        $needsSave = true;
                        $this->info("Fixed {$field} for event ID: {$event->id} (JSON decoded)");
                    } else {
                        // If it's not JSON, convert to array with single item or handle as needed
                        if ($field === 'gallery') {
                            $event->$field = [$rawValue];
                        } else {
                            // For translatable fields, try to create proper structure
                            $event->$field = ['fr' => $rawValue];
                        }
                        $needsSave = true;
                        $this->info("Fixed {$field} for event ID: {$event->id} (converted to array)");
                    }
                }
            }

            if ($needsSave) {
                $event->save();
                $fixed++;
            }
        }

        $this->info("Fixed {$fixed} event records with array field issues.");
    }
}
