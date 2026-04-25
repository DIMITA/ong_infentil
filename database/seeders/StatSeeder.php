<?php
namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['key' => 'children_helped',  'value' => 30,   'label_fr' => 'Enfants accompagnés',     'label_en' => 'Children supported',      'icon' => 'heroicon-o-heart',                    'order' => 1],
            ['key' => 'consultations',    'value' => 300,  'label_fr' => 'Consultations médicales',  'label_en' => 'Medical consultations',    'icon' => 'heroicon-o-clipboard-document-check', 'order' => 2],
            ['key' => 'missions',         'value' => 8,    'label_fr' => 'Missions bénévoles',       'label_en' => 'Volunteer missions',       'icon' => 'heroicon-o-globe-alt',                'order' => 3],
            ['key' => 'partners',         'value' => 12,   'label_fr' => 'Partenaires & bénévoles',  'label_en' => 'Partners & volunteers',    'icon' => 'heroicon-o-building-office',          'order' => 4],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['key' => $stat['key']], $stat);
        }
    }
}
