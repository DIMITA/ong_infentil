<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'org_name_fr', 'value' => 'Graines de vie'],
            ['key' => 'org_name_en', 'value' => 'Graines de vie'],
            ['key' => 'contact_email', 'value' => 'contact@grainesdevie-benin.org'],
            ['key' => 'contact_phone', 'value' => '+229 97 00 00 00'],
            ['key' => 'address_fr', 'value' => 'Adjaglo, région d\'Ouidah, République du Bénin'],
            ['key' => 'address_en', 'value' => 'Adjaglo, Ouidah region, Republic of Benin'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/grainesdevie.benin'],
            ['key' => 'twitter_url', 'value' => ''],
            ['key' => 'instagram_url', 'value' => ''],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/playlist?list=PLzdsF-mDmU6N0iKtsWi5rUxB1s4DzKRyn'],

            ['key' => 'hero_title_fr', 'value' => "Des graines de vie\npour chaque enfant"],
            ['key' => 'hero_title_en', 'value' => "Seeds of life\nfor every child"],
            ['key' => 'hero_subtitle_fr', 'value' => "Association humanitaire béninoise engagée pour la santé, l'éducation et la protection des enfants vulnérables dans la région d'Ouidah."],
            ['key' => 'hero_subtitle_en', 'value' => "Beninese humanitarian association committed to health, education and protection of vulnerable children in the Ouidah region."],

            ['key' => 'donorbox_campaign_url', 'value' => 'https://donorbox.org/graines-de-vie'],

            ['key' => 'footer_text_fr', 'value' => "Ensemble, plantons aujourd'hui les graines d'un avenir meilleur pour les enfants d'Ouidah."],
            ['key' => 'footer_text_en', 'value' => "Together, let's plant the seeds of a better future for the children of Ouidah."],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
