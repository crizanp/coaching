<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Practical Information Events (Active)
        Event::create([
            'title' => [
                'fr' => 'Gestion du Stress au Quotidien',
                'en' => 'Daily Stress Management'
            ],
            'slug' => 'gestion-stress-quotidien',
            'description' => [
                'fr' => 'Techniques pratiques pour gérer le stress et l\'anxiété dans votre vie quotidienne',
                'en' => 'Practical techniques to manage stress and anxiety in your daily life'
            ],
            'content' => [
                'fr' => 'Découvrez des outils concrets et efficaces pour mieux gérer votre stress au quotidien. Cette formation vous apprendra à identifier vos sources de stress, à développer des stratégies d\'adaptation et à cultiver un état d\'esprit plus serein.',
                'en' => 'Discover concrete and effective tools to better manage your daily stress. This training will teach you to identify your stress sources, develop coping strategies and cultivate a more serene mindset.'
            ],
            'type' => 'practical',
            'status' => 'active',
            'featured_image' => 'events/stress-management.jpg',
            'duration' => '2 heures',
            'benefits' => [
                'fr' => [
                    'Techniques de respiration et de relaxation',
                    'Identification des déclencheurs de stress',
                    'Stratégies d\'adaptation personnalisées',
                    'Exercices pratiques à utiliser au quotidien'
                ],
                'en' => [
                    'Breathing and relaxation techniques',
                    'Stress trigger identification',
                    'Personalized coping strategies',
                    'Practical exercises for daily use'
                ]
            ],
            'program' => [
                'fr' => [
                    'Introduction: Comprendre le stress',
                    'Techniques de respiration consciente',
                    'Exercices de relaxation rapide',
                    'Plan d\'action personnel'
                ],
                'en' => [
                    'Introduction: Understanding stress',
                    'Conscious breathing techniques',
                    'Quick relaxation exercises',
                    'Personal action plan'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1
        ]);

        Event::create([
            'title' => [
                'fr' => 'Communication Bienveillante',
                'en' => 'Compassionate Communication'
            ],
            'slug' => 'communication-bienveillante',
            'description' => [
                'fr' => 'Apprenez les bases de la communication non-violente pour améliorer vos relations',
                'en' => 'Learn the basics of non-violent communication to improve your relationships'
            ],
            'content' => [
                'fr' => 'La communication bienveillante est un art qui permet de créer des liens authentiques et de résoudre les conflits de manière constructive. Cette session vous donnera des outils pratiques pour mieux exprimer vos besoins et écouter ceux des autres.',
                'en' => 'Compassionate communication is an art that allows creating authentic connections and resolving conflicts constructively. This session will give you practical tools to better express your needs and listen to others.'
            ],
            'type' => 'practical',
            'status' => 'active',
            'featured_image' => 'events/communication.jpg',
            'duration' => '90 minutes',
            'benefits' => [
                'fr' => [
                    'Amélioration des relations personnelles',
                    'Résolution constructive des conflits',
                    'Expression authentique des émotions',
                    'Écoute empathique'
                ],
                'en' => [
                    'Improved personal relationships',
                    'Constructive conflict resolution',
                    'Authentic emotional expression',
                    'Empathetic listening'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2
        ]);

        // Workshop Events (Upcoming)
        Event::create([
            'title' => [
                'fr' => 'Atelier de Sophrologie en Groupe',
                'en' => 'Group Sophrology Workshop'
            ],
            'slug' => 'atelier-sophrologie-groupe',
            'description' => [
                'fr' => 'Découvrez la sophrologie en groupe dans un cadre bienveillant et ressourçant',
                'en' => 'Discover sophrology in a group setting in a caring and restorative environment'
            ],
            'content' => [
                'fr' => 'Rejoignez-nous pour un atelier de sophrologie en groupe où vous découvrirez les techniques de relaxation, de respiration et de visualisation positive. Un moment de détente et de partage dans un environnement sécurisant.',
                'en' => 'Join us for a group sophrology workshop where you will discover relaxation, breathing and positive visualization techniques. A moment of relaxation and sharing in a safe environment.'
            ],
            'type' => 'workshop',
            'status' => 'upcoming',
            'featured_image' => 'events/sophrology-group.jpg',
            'price' => 45.00,
            'duration' => '2 heures',
            'max_participants' => 12,
            'current_participants' => 6,
            'event_date' => Carbon::now()->addDays(15)->setTime(14, 30),
            'registration_deadline' => Carbon::now()->addDays(12),
            'location' => [
                'fr' => [
                    'type' => 'offline',
                    'address' => 'Centre de Bien-être',
                    'city' => 'Fort-de-France, Martinique'
                ],
                'en' => [
                    'type' => 'offline',
                    'address' => 'Wellness Center',
                    'city' => 'Fort-de-France, Martinique'
                ]
            ],
            'benefits' => [
                'fr' => [
                    'Détente profonde et relaxation',
                    'Techniques de gestion du stress',
                    'Renforcement de la confiance en soi',
                    'Partage d\'expérience en groupe'
                ],
                'en' => [
                    'Deep relaxation and rest',
                    'Stress management techniques',
                    'Self-confidence building',
                    'Group experience sharing'
                ]
            ],
            'requirements' => [
                'fr' => [
                    'Tenue confortable',
                    'Tapis de yoga (fourni si besoin)',
                    'Bouteille d\'eau'
                ],
                'en' => [
                    'Comfortable clothing',
                    'Yoga mat (provided if needed)',
                    'Water bottle'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'allow_registration' => true,
            'sort_order' => 1
        ]);

        Event::create([
            'title' => [
                'fr' => 'Weekend de Développement Personnel',
                'en' => 'Personal Development Weekend'
            ],
            'slug' => 'weekend-developpement-personnel',
            'description' => [
                'fr' => 'Un weekend intensif pour explorer votre potentiel et définir vos objectifs de vie',
                'en' => 'An intensive weekend to explore your potential and define your life goals'
            ],
            'content' => [
                'fr' => 'Offrez-vous un weekend complet dédié à votre développement personnel. Au programme: ateliers d\'introspection, techniques de coaching, définition d\'objectifs et plan d\'action personnalisé.',
                'en' => 'Treat yourself to a complete weekend dedicated to your personal development. Program includes: introspection workshops, coaching techniques, goal setting and personalized action plan.'
            ],
            'type' => 'workshop',
            'status' => 'upcoming',
            'featured_image' => 'events/personal-development.jpg',
            'price' => 180.00,
            'duration' => '2 jours',
            'max_participants' => 8,
            'current_participants' => 3,
            'event_date' => Carbon::now()->addDays(30)->setTime(9, 0),
            'registration_deadline' => Carbon::now()->addDays(25),
            'location' => [
                'fr' => [
                    'type' => 'offline',
                    'address' => 'Résidence Les Jardins',
                    'city' => 'Sainte-Anne, Martinique'
                ],
                'en' => [
                    'type' => 'offline',
                    'address' => 'Les Jardins Residence',
                    'city' => 'Sainte-Anne, Martinique'
                ]
            ],
            'benefits' => [
                'fr' => [
                    'Clarification des objectifs de vie',
                    'Développement de l\'estime de soi',
                    'Techniques de motivation',
                    'Networking avec d\'autres participants',
                    'Suivi post-formation'
                ],
                'en' => [
                    'Life goals clarification',
                    'Self-esteem development',
                    'Motivation techniques',
                    'Networking with other participants',
                    'Post-training follow-up'
                ]
            ],
            'program' => [
                'fr' => [
                    'Samedi 9h: Accueil et bilan personnel',
                    'Samedi 11h: Atelier valeurs et croyances',
                    'Samedi 14h: Définition d\'objectifs SMART',
                    'Samedi 16h: Plan d\'action personnalisé',
                    'Dimanche 9h: Techniques de motivation',
                    'Dimanche 11h: Gestion des obstacles',
                    'Dimanche 14h: Mise en pratique',
                    'Dimanche 16h: Bilan et engagement'
                ],
                'en' => [
                    'Saturday 9am: Welcome and personal assessment',
                    'Saturday 11am: Values and beliefs workshop',
                    'Saturday 2pm: SMART goal setting',
                    'Saturday 4pm: Personalized action plan',
                    'Sunday 9am: Motivation techniques',
                    'Sunday 11am: Obstacle management',
                    'Sunday 2pm: Practical application',
                    'Sunday 4pm: Assessment and commitment'
                ]
            ],
            'requirements' => [
                'fr' => [
                    'Carnet de notes personnel',
                    'Esprit d\'ouverture',
                    'Engagement pour les deux jours complets'
                ],
                'en' => [
                    'Personal notebook',
                    'Open mindset',
                    'Commitment for both full days'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'allow_registration' => true,
            'sort_order' => 2
        ]);

        // Workshop On Demand (Active)
        Event::create([
            'title' => [
                'fr' => 'Séance de Groupe Personnalisée',
                'en' => 'Customized Group Session'
            ],
            'slug' => 'seance-groupe-personnalisee',
            'description' => [
                'fr' => 'Organisez votre propre séance de groupe adaptée aux besoins de votre équipe ou famille',
                'en' => 'Organize your own group session adapted to your team or family needs'
            ],
            'content' => [
                'fr' => 'Vous souhaitez organiser une séance de bien-être pour votre équipe, votre famille ou vos amis ? Je propose des séances de groupe personnalisées qui s\'adaptent à vos besoins spécifiques et votre emploi du temps.',
                'en' => 'Do you want to organize a wellness session for your team, family or friends? I offer customized group sessions that adapt to your specific needs and schedule.'
            ],
            'type' => 'workshop',
            'status' => 'active',
            'featured_image' => 'events/custom-group.jpg',
            'price' => 120.00,
            'duration' => 'Variable (1h30 à 3h)',
            'max_participants' => 15,
            'gallery' => [
                'events/gallery/group1.jpg',
                'events/gallery/group2.jpg',
                'events/gallery/group3.jpg'
            ],
            'benefits' => [
                'fr' => [
                    'Programme adapté à vos besoins',
                    'Flexibilité des horaires',
                    'Déplacement possible à domicile',
                    'Cohésion d\'équipe renforcée',
                    'Tarif dégressif selon le nombre'
                ],
                'en' => [
                    'Program adapted to your needs',
                    'Schedule flexibility',
                    'Home visits possible',
                    'Enhanced team cohesion',
                    'Decreasing rate by number'
                ]
            ],
            'requirements' => [
                'fr' => [
                    'Minimum 4 participants',
                    'Espace calme disponible',
                    'Définition des objectifs en amont'
                ],
                'en' => [
                    'Minimum 4 participants',
                    'Quiet space available',
                    'Prior goal definition'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'allow_registration' => false, // Contact required
            'sort_order' => 1
        ]);

        Event::create([
            'title' => [
                'fr' => 'Atelier Entreprise: Bien-être au Travail',
                'en' => 'Corporate Workshop: Workplace Wellness'
            ],
            'slug' => 'atelier-entreprise-bien-etre',
            'description' => [
                'fr' => 'Formation professionnelle pour améliorer le bien-être et la productivité de vos équipes',
                'en' => 'Professional training to improve your teams\' wellness and productivity'
            ],
            'content' => [
                'fr' => 'Un programme spécialement conçu pour les entreprises souhaitant investir dans le bien-être de leurs collaborateurs. Techniques de gestion du stress, amélioration de la communication et renforcement de la cohésion d\'équipe.',
                'en' => 'A program specially designed for companies wanting to invest in their employees\' wellness. Stress management techniques, communication improvement and team cohesion strengthening.'
            ],
            'type' => 'workshop',
            'status' => 'active',
            'featured_image' => 'events/corporate-wellness.jpg',
            'price' => 350.00,
            'duration' => 'Demi-journée (4h)',
            'max_participants' => 20,
            'gallery' => [
                'events/gallery/corporate1.jpg',
                'events/gallery/corporate2.jpg'
            ],
            'benefits' => [
                'fr' => [
                    'Réduction du stress au travail',
                    'Amélioration de la communication',
                    'Renforcement de l\'esprit d\'équipe',
                    'Outils pratiques utilisables au quotidien',
                    'Amélioration de la productivité'
                ],
                'en' => [
                    'Reduced workplace stress',
                    'Improved communication',
                    'Enhanced team spirit',
                    'Daily practical tools',
                    'Improved productivity'
                ]
            ],
            'program' => [
                'fr' => [
                    '9h-10h: Diagnostic bien-être équipe',
                    '10h-11h: Techniques anti-stress',
                    '11h15-12h: Communication positive',
                    '14h-15h: Cohésion d\'équipe',
                    '15h-16h: Plan d\'action et suivi'
                ],
                'en' => [
                    '9am-10am: Team wellness assessment',
                    '10am-11am: Anti-stress techniques',
                    '11:15am-12pm: Positive communication',
                    '2pm-3pm: Team building',
                    '3pm-4pm: Action plan and follow-up'
                ]
            ],
            'requirements' => [
                'fr' => [
                    'Salle de réunion spacieuse',
                    'Projecteur et matériel audio',
                    'Engagement de la direction'
                ],
                'en' => [
                    'Spacious meeting room',
                    'Projector and audio equipment',
                    'Management commitment'
                ]
            ],
            'is_featured' => true,
            'is_active' => true,
            'allow_registration' => false, // Contact required
            'sort_order' => 2
        ]);
    }
}
