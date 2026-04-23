<?php
namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['key' => 'children_helped', 'value' => 12500, 'label_fr' => 'Enfants aidés', 'label_en' => 'Children helped', 'icon' => 'heroicon-o-heart', 'order' => 1],
            ['key' => 'zones_covered', 'value' => 48, 'label_fr' => 'Zones couvertes', 'label_en' => 'Zones covered', 'icon' => 'heroicon-o-map-pin', 'order' => 2],
            ['key' => 'years_active', 'value' => 12, 'label_fr' => "Années d'activité", 'label_en' => 'Years of activity', 'icon' => 'heroicon-o-calendar', 'order' => 3],
            ['key' => 'partners', 'value' => 35, 'label_fr' => 'Partenaires', 'label_en' => 'Partners', 'icon' => 'heroicon-o-building-office', 'order' => 4],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['key' => $stat['key']], $stat);
        }
    }
}
