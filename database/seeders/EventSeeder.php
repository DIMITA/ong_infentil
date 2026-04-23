<?php
namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title_fr' => 'Caravane de santé infantile — Cotonou 2025',
                'title_en' => 'Children Health Caravan — Cotonou 2025',
                'description_fr' => 'Grande caravane médicale offrant des consultations gratuites, vaccinations et dépistages nutritionnels pour les enfants de 0 à 10 ans dans les quartiers périphériques de Cotonou.',
                'description_en' => 'Major medical caravan providing free consultations, vaccinations and nutritional screenings for children aged 0-10 in the outskirts of Cotonou.',
                'date' => Carbon::now()->addDays(45),
                'location' => 'Cotonou, Bénin',
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title_fr' => 'Forum International Santé Enfant — Abomey 2025',
                'title_en' => 'International Child Health Forum — Abomey 2025',
                'description_fr' => "Forum réunissant experts, ONG et gouvernements pour débattre des stratégies de réduction de la mortalité infantile en Afrique de l'Ouest.",
                'description_en' => 'Forum bringing together experts, NGOs and governments to discuss strategies for reducing child mortality in West Africa.',
                'date' => Carbon::now()->addDays(90),
                'location' => 'Abomey, Bénin',
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title_fr' => 'Journée Nutrition Parakou 2024',
                'title_en' => 'Nutrition Day Parakou 2024',
                'description_fr' => 'Journée de sensibilisation à la nutrition infantile avec distribution de compléments alimentaires et formation des mères.',
                'description_en' => 'Child nutrition awareness day with distribution of food supplements and training for mothers.',
                'date' => Carbon::now()->subDays(60),
                'location' => 'Parakou, Bénin',
                'status' => 'completed',
                'is_active' => true,
            ],
            [
                'title_fr' => 'Distribution kits scolaires 2024',
                'title_en' => 'School kit distribution 2024',
                'description_fr' => 'Distribution de 500 kits scolaires complets à des enfants issus de familles défavorisées dans la région de Porto-Novo.',
                'description_en' => 'Distribution of 500 complete school kits to children from disadvantaged families in the Porto-Novo region.',
                'date' => Carbon::now()->subDays(120),
                'location' => 'Porto-Novo, Bénin',
                'status' => 'completed',
                'is_active' => true,
            ],
            [
                'title_fr' => 'Campagne vaccination rougeole 2024',
                'title_en' => 'Measles vaccination campaign 2024',
                'description_fr' => "Campagne de vaccination contre la rougeole ayant touché 3 000 enfants dans 12 villages de la région de l'Atacora.",
                'description_en' => 'Measles vaccination campaign reaching 3,000 children in 12 villages in the Atacora region.',
                'date' => Carbon::now()->subDays(200),
                'location' => "Atacora, Bénin",
                'status' => 'completed',
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            $event['slug'] = Str::slug($event['title_fr']);
            Event::updateOrCreate(['slug' => $event['slug']], $event);
        }
    }
}
