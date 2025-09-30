<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $guides = [
            [
                'title' => '5 Exercices de Respiration Anti-Stress',
                'slug' => 'sophrology-stress-relief',
                'description' => 'Apprenez des techniques de respiration sophrologique puissantes pour réduire instantanément le stress et l\'anxiété dans votre quotidien.',
                'icon' => 'fa-lungs',
                'benefits' => [
                    'Réduire le stress en 5 minutes',
                    'Exercices faciles pour débutants',
                    'Techniques utilisables partout',
                    'Résultats immédiats'
                ],
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Guide du Débutant en Sophrologie',
                'slug' => 'beginner-sophrology',
                'description' => 'Votre introduction complète à la sophrologie avec instructions détaillées et exercices pratiques.',
                'icon' => 'fa-seedling',
                'benefits' => [
                    'Guide complet pour débutants',
                    'Instructions étape par étape',
                    'Routine de pratique quotidienne',
                    'Conseils professionnels'
                ],
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Techniques PNL pour la Confiance en Soi',
                'slug' => 'nlp-confidence-boost',
                'description' => 'Méthodes PNL puissantes pour construire une confiance en soi durable et surmonter les croyances limitantes.',
                'icon' => 'fa-brain',
                'benefits' => [
                    'Renforcer la confiance en soi',
                    'Surmonter les croyances limitantes',
                    'Techniques PNL pratiques',
                    'Applications concrètes'
                ],
                'is_active' => true,
                'sort_order' => 3
            ]
        ];

        foreach ($guides as $guideData) {
            Guide::create($guideData);
        }
    }
}
