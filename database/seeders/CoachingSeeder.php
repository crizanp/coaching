<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CoachingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Coach Admin',
            'email' => 'admin@coaching.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create services
        $services = [
            [
                'name' => [
                    'fr' => 'Sophrologie',
                    'en' => 'Sophrology'
                ],
                'description' => [
                    'fr' => 'Une méthode douce pour retrouver bien-être et sérénité',
                    'en' => 'A gentle method to find well-being and serenity'
                ],
                'content' => [
                    'fr' => '<h2>Qu\'est-ce que la Sophrologie ?</h2><p>La sophrologie est une méthode psychocorporelle qui combine des techniques de relaxation, de respiration et de visualisation positive. Elle permet de développer la conscience de soi et d\'atteindre un équilibre entre le corps et l\'esprit.</p><h3>Comment ça fonctionne ?</h3><p>Lors des séances, nous utilisons des exercices simples de respiration, de détente musculaire et de visualisation. Ces techniques vous aident à gérer le stress, améliorer votre sommeil et développer votre confiance en vous.</p>',
                    'en' => '<h2>What is Sophrology?</h2><p>Sophrology is a psychosomatic method that combines relaxation techniques, breathing and positive visualization. It helps develop self-awareness and achieve balance between body and mind.</p><h3>How does it work?</h3><p>During sessions, we use simple breathing exercises, muscle relaxation and visualization. These techniques help you manage stress, improve your sleep and develop your self-confidence.</p>'
                ],
                'slug' => 'sophrologie',
                'benefits' => [
                    'fr' => ['Réduction du stress', 'Amélioration du sommeil', 'Développement de la confiance en soi', 'Gestion des émotions'],
                    'en' => ['Stress reduction', 'Sleep improvement', 'Self-confidence development', 'Emotion management']
                ],
                'session_format' => [
                    'fr' => ['Séances individuelles : 60 minutes', 'Séances de groupe : 90 minutes', 'Suivi personnalisé', 'Exercices à pratiquer à domicile'],
                    'en' => ['Individual sessions: 60 minutes', 'Group sessions: 90 minutes', 'Personalized follow-up', 'Home practice exercises']
                ],
                'price_individual' => 65.00,
                'price_group' => 25.00,
                'duration' => '60 minutes',
                'icon' => 'leaf',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => [
                    'fr' => 'Hypnose',
                    'en' => 'Hypnosis'
                ],
                'description' => [
                    'fr' => 'Accompagnement en hypnose thérapeutique pour un changement en profondeur',
                    'en' => 'Therapeutic hypnosis support for deep change'
                ],
                'content' => [
                    'fr' => '<h2>L\'Hypnose Ericksonienne</h2><p>L\'hypnose que je pratique est une hypnose douce et respectueuse, basée sur les travaux de Milton Erickson. Elle permet d\'accéder à vos ressources inconscientes pour créer des changements durables.</p><h3>Pour quoi ?</h3><p>L\'hypnose peut vous aider dans de nombreux domaines : arrêter de fumer, perdre du poids, gérer les phobies, améliorer la confiance en soi, traiter les troubles du sommeil...</p>',
                    'en' => '<h2>Ericksonian Hypnosis</h2><p>The hypnosis I practice is gentle and respectful, based on Milton Erickson\'s work. It allows access to your unconscious resources to create lasting changes.</p><h3>What for?</h3><p>Hypnosis can help you in many areas: quit smoking, lose weight, manage phobias, improve self-confidence, treat sleep disorders...</p>'
                ],
                'slug' => 'hypnose',
                'benefits' => [
                    'fr' => ['Changements durables', 'Accès aux ressources inconscientes', 'Thérapie douce et naturelle', 'Résultats rapides'],
                    'en' => ['Lasting changes', 'Access to unconscious resources', 'Gentle and natural therapy', 'Quick results']
                ],
                'session_format' => [
                    'fr' => ['Première consultation : 90 minutes', 'Séances de suivi : 60 minutes', 'Enregistrement des séances fourni', 'Suivi personnalisé'],
                    'en' => ['First consultation: 90 minutes', 'Follow-up sessions: 60 minutes', 'Session recordings provided', 'Personalized follow-up']
                ],
                'price_individual' => 75.00,
                'duration' => '60-90 minutes',
                'icon' => 'moon',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => [
                    'fr' => 'Coaching PNL',
                    'en' => 'NLP Coaching'
                ],
                'description' => [
                    'fr' => 'Programmation Neuro-Linguistique pour atteindre vos objectifs',
                    'en' => 'Neuro-Linguistic Programming to achieve your goals'
                ],
                'content' => [
                    'fr' => '<h2>La PNL - Programmation Neuro-Linguistique</h2><p>La PNL est un ensemble d\'outils et de techniques qui vous permettent de mieux comprendre votre fonctionnement mental et de développer vos compétences relationnelles et communicationnelles.</p><h3>Approche pratique</h3><p>Le coaching PNL est orienté solution et résultat. Nous travaillons ensemble pour identifier vos objectifs, lever les blocages et développer de nouvelles stratégies de réussite.</p>',
                    'en' => '<h2>NLP - Neuro-Linguistic Programming</h2><p>NLP is a set of tools and techniques that allow you to better understand your mental functioning and develop your relational and communication skills.</p><h3>Practical approach</h3><p>NLP coaching is solution and result oriented. We work together to identify your goals, remove blockages and develop new success strategies.</p>'
                ],
                'slug' => 'coaching-pnl',
                'benefits' => [
                    'fr' => ['Amélioration de la communication', 'Développement du leadership', 'Atteinte des objectifs', 'Changement des schémas limitants'],
                    'en' => ['Communication improvement', 'Leadership development', 'Goal achievement', 'Changing limiting patterns']
                ],
                'session_format' => [
                    'fr' => ['Séances individuelles : 90 minutes', 'Programmes sur mesure', 'Exercices pratiques', 'Outils à utiliser au quotidien'],
                    'en' => ['Individual sessions: 90 minutes', 'Customized programs', 'Practical exercises', 'Daily tools']
                ],
                'price_individual' => 85.00,
                'duration' => '90 minutes',
                'icon' => 'brain',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        // Create testimonials
        $testimonials = [
            [
                'client_name' => 'Marie D.',
                'client_location' => 'Paris',
                'testimonial' => [
                    'fr' => 'Les séances de sophrologie m\'ont vraiment aidée à gérer mon stress au travail. Je me sens plus sereine et confiante. Merci !',
                    'en' => 'The sophrology sessions really helped me manage my work stress. I feel more serene and confident. Thank you!'
                ],
                'rating' => 5,
                'service_id' => 1,
                'is_featured' => true,
                'is_active' => true,
                'testimonial_date' => now()->subDays(30),
            ],
            [
                'client_name' => 'Jean-Pierre L.',
                'client_location' => 'Lyon',
                'testimonial' => [
                    'fr' => 'J\'ai réussi à arrêter de fumer grâce à l\'hypnose. Après 20 ans de tabac, je n\'y croyais plus. Mais ça a marché !',
                    'en' => 'I managed to quit smoking thanks to hypnosis. After 20 years of smoking, I didn\'t believe it anymore. But it worked!'
                ],
                'rating' => 5,
                'service_id' => 2,
                'is_featured' => true,
                'is_active' => true,
                'testimonial_date' => now()->subDays(15),
            ],
            [
                'client_name' => 'Sophie M.',
                'client_location' => 'Marseille',
                'testimonial' => [
                    'fr' => 'Le coaching PNL m\'a permis de développer ma confiance en moi et d\'atteindre mes objectifs professionnels. Une approche très efficace !',
                    'en' => 'NLP coaching allowed me to develop my self-confidence and achieve my professional goals. A very effective approach!'
                ],
                'rating' => 5,
                'service_id' => 3,
                'is_featured' => true,
                'is_active' => true,
                'testimonial_date' => now()->subDays(7),
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }

        // Create pages
        $pages = [
            [
                'slug' => 'about',
                'title' => [
                    'fr' => 'À Propos',
                    'en' => 'About'
                ],
                'content' => [
                    'fr' => '<h1>Voici mon histoire</h1><p>Passionnée par l\'accompagnement et le bien-être, je vous guide vers un mieux-être grâce à la sophrologie, l\'hypnose et la PNL.</p><p>Diplômée et certifiée, je mets à votre service mon expertise pour vous aider à atteindre vos objectifs personnels et professionnels.</p><h2>Mon approche</h2><p>Chaque personne est unique, c\'est pourquoi j\'adapte mes méthodes à vos besoins spécifiques. Dans un cadre bienveillant et confidentiel, nous travaillons ensemble pour révéler votre potentiel.</p>',
                    'en' => '<h1>Here is my story</h1><p>Passionate about support and well-being, I guide you towards better well-being through sophrology, hypnosis and NLP.</p><p>Graduated and certified, I put my expertise at your service to help you achieve your personal and professional goals.</p><h2>My approach</h2><p>Each person is unique, which is why I adapt my methods to your specific needs. In a caring and confidential setting, we work together to reveal your potential.</p>'
                ],
                'meta_title' => [
                    'fr' => 'À Propos - Coach en Sophrologie, Hypnose et PNL',
                    'en' => 'About - Sophrology, Hypnosis and NLP Coach'
                ],
                'meta_description' => [
                    'fr' => 'Découvrez mon parcours et mon approche en sophrologie, hypnose et PNL. Accompagnement personnalisé pour votre bien-être.',
                    'en' => 'Discover my journey and approach in sophrology, hypnosis and NLP. Personalized support for your well-being.'
                ],
                'is_active' => true,
                'show_in_menu' => true,
                'menu_order' => 1,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }

        // Create settings
        $settings = [
            [
                'key' => 'site_name',
                'value' => [
                    'fr' => 'SSJCHRYSALIDE',
                    'en' => 'SSJCHRYSALIDE'
                ],
                'type' => 'json',
                'group' => 'general',
            ],
            [
                'key' => 'site_tagline',
                'value' => [
                    'fr' => 'Accompagnement de personnes qui traversent des périodes de stress, fatigue émotionnelle, troubles du sommeil, blocages personnels ou qui veulent simplement opérer des changements et atteindre de nouveaux objectifs.',
                    'en' => 'Supporting people who are going through periods of stress, emotional fatigue, sleep disorders, personal blockages, or who simply want to make changes and reach new goals.'
                ],
                'type' => 'json',
                'group' => 'general',
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@coaching.com',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+33 1 23 45 67 89',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'address',
                'value' => [
                    'fr' => '123 Rue de la Paix, 75001 Paris',
                    'en' => '123 Peace Street, 75001 Paris'
                ],
                'type' => 'json',
                'group' => 'contact',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/coaching',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/coaching',
                'type' => 'text',
                'group' => 'social',
            ],
        ];

        foreach ($settings as $settingData) {
            Setting::create($settingData);
        }
    }
}
