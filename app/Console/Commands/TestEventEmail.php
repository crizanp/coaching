<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\EventConfirmation;
use App\Models\Event;
use App\Models\EventApplication;
use Illuminate\Support\Facades\Mail;

class TestEventEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:event-email {type=confirmed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test event confirmation email template';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        
        // Create a fake event for testing
        $event = new Event([
            'title' => ['fr' => 'Atelier de Développement Émotionnel', 'en' => 'Emotional Development Workshop'],
            'description' => ['fr' => 'Un atelier pour apprendre à gérer ses émotions', 'en' => 'A workshop to learn emotion management'],
            'content' => ['fr' => "Un atelier riche en découvertes où chacun repartira avec les clés pour :\n• apprendre à reconnaître les émotions\n• comprendre le besoin caché derrière\n• mieux communiquer et interagir avec ses proches mais aussi ses collègues", 'en' => 'A rich workshop where everyone will leave with keys to understand emotions'],
            'type' => 'workshop',
            'status' => 'active',
            'price' => 75.00,
            'duration' => '2 heures',
            'location' => ['fr' => 'Martinique', 'en' => 'Martinique'],
            'event_date' => now()->addDays(7),
        ]);
        $event->id = 1;
        
        // Create a fake application
        $application = new EventApplication([
            'name' => 'Marie Dubois',
            'email' => 'marie.dubois@example.com',
            'phone' => '+596 696 12 34 56',
            'company' => 'ABC Entreprise',
            'message' => 'Je suis très intéressée par cet atelier pour améliorer ma communication.',
            'status' => $type,
        ]);
        $application->id = 1;
        $application->setRelation('event', $event);
        
        // Send test email
        try {
            $mailable = new EventConfirmation($application, $type);
            
            // For testing, we'll send to a test email
            Mail::to('test@example.com')->send($mailable);
            
            $this->info("Test email sent successfully for type: {$type}");
            $this->info("Email would be sent to: {$application->email}");
            
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
        }
    }
}
