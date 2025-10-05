<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class FixEventGalleryData extends Command
{
    protected $signature = 'fix:event-gallery-data';
    protected $description = 'Fix event gallery data that was stored as string instead of array';

    public function handle()
    {
        $this->info('Fixing event gallery data...');

        $events = Event::all();
        $fixed = 0;

        foreach ($events as $event) {
            // Get the raw attribute value to check the actual data type
            $rawGallery = $event->getAttributes()['gallery'] ?? null;
            
            if (is_string($rawGallery) && !empty($rawGallery)) {
                // Try to decode JSON string first
                $decoded = json_decode($rawGallery, true);
                
                if (is_array($decoded)) {
                    $event->gallery = $decoded;
                    $event->save();
                    $this->info("Fixed event ID: {$event->id} - {$event->title} (JSON decoded)");
                    $fixed++;
                } else {
                    // If it's not JSON, convert to array with single item
                    $event->gallery = [$rawGallery];
                    $event->save();
                    $this->info("Fixed event ID: {$event->id} - {$event->title} (converted to array)");
                    $fixed++;
                }
            } elseif (is_array($event->gallery)) {
                $this->info("Event ID: {$event->id} already has correct gallery format");
            } else {
                $this->info("Event ID: {$event->id} has empty gallery");
            }
        }

        $this->info("Fixed {$fixed} event records.");
    }
}
