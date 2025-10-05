<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;

class FixServiceArrayData extends Command
{
    protected $signature = 'fix:service-array-data';
    protected $description = 'Fix service array data that was stored as string instead of array';

    public function handle()
    {
        $this->info('Fixing service array data...');

        $services = Service::all();
        $fixed = 0;

        foreach ($services as $service) {
            $updated = false;
            
            // Fix benefits field
            $rawBenefits = $service->getAttributes()['benefits'] ?? null;
            if (is_string($rawBenefits) && !empty($rawBenefits)) {
                $decoded = json_decode($rawBenefits, true);
                if (is_array($decoded)) {
                    $service->benefits = $decoded;
                    $updated = true;
                    $this->info("Fixed benefits for service: {$service->name}");
                }
            }
            
            // Fix session_format field
            $rawSessionFormat = $service->getAttributes()['session_format'] ?? null;
            if (is_string($rawSessionFormat) && !empty($rawSessionFormat)) {
                $decoded = json_decode($rawSessionFormat, true);
                if (is_array($decoded)) {
                    $service->session_format = $decoded;
                    $updated = true;
                    $this->info("Fixed session_format for service: {$service->name}");
                }
            }
            
            if ($updated) {
                $service->save();
                $fixed++;
            }
        }

        $this->info("Fixed {$fixed} service records.");
    }
}
