<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Event;
use App\Models\EventApplication;

class VerifyMigration extends Command
{
    protected $signature = 'verify:migration';
    protected $description = 'Verify all data was migrated successfully';

    public function handle()
    {
        $this->info('Verifying MySQL migration...');
        
        $this->info('Users: ' . User::count());
        $this->info('Services: ' . Service::count());
        $this->info('Appointments: ' . Appointment::count());
        $this->info('Blogs: ' . Blog::count());
        $this->info('Testimonials: ' . Testimonial::count());
        $this->info('Pages: ' . Page::count());
        $this->info('Settings: ' . Setting::count());
        $this->info('Events: ' . Event::count());
        $this->info('Event Applications: ' . EventApplication::count());
        
        $this->info('Migration verification completed!');
    }
}
