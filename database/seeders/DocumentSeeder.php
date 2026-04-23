<?php
namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            ['title' => 'Rapport Annuel ONG Infentil 2024', 'category' => 'rapport_annuel', 'year' => 2024, 'visibility' => 'public', 'description' => "Bilan complet des activités, projets et financements de l'ONG pour l'année 2024.", 'tags' => ['annuel', 'bilan', '2024']],
            ['title' => 'Rapport Annuel ONG Infentil 2023', 'category' => 'rapport_annuel', 'year' => 2023, 'visibility' => 'public', 'description' => "Bilan complet des activités de l'ONG pour l'année 2023.", 'tags' => ['annuel', 'bilan', '2023']],
            ['title' => 'Bilan Financier 2024', 'category' => 'bilan', 'year' => 2024, 'visibility' => 'public', 'description' => 'Bilan financier détaillé avec états des comptes et audits.', 'tags' => ['financier', '2024']],
            ['title' => "Communiqué — Lancement caravane Cotonou", 'category' => 'communique', 'year' => 2025, 'visibility' => 'public', 'description' => 'Communiqué de presse officiel annonçant la caravane de santé infantile de Cotonou 2025.', 'tags' => ['presse', 'cotonou']],
            ['title' => 'Rapport Impact Nutrition 2023', 'category' => 'rapport_annuel', 'year' => 2023, 'visibility' => 'public', 'description' => 'Rapport spécifique sur les actions nutrition et leurs impacts mesurables.', 'tags' => ['nutrition', 'impact']],
        ];

        foreach ($documents as $doc) {
            Document::updateOrCreate(['title' => $doc['title']], $doc);
        }
    }
}
