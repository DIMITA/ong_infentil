<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'org_name_fr', 'value' => 'ONG Infentil'],
            ['key' => 'org_name_en', 'value' => 'NGO Infentil'],
            ['key' => 'contact_email', 'value' => 'contact@ong-infentil.org'],
            ['key' => 'contact_phone', 'value' => '+229 00 00 00 00'],
            ['key' => 'address_fr', 'value' => 'Cotonou, République du Bénin'],
            ['key' => 'address_en', 'value' => 'Cotonou, Republic of Benin'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/ong-infentil'],
            ['key' => 'twitter_url', 'value' => ''],
            ['key' => 'instagram_url', 'value' => ''],
            ['key' => 'youtube_url', 'value' => ''],
            ['key' => 'hero_title_fr', 'value' => "Ensemble pour la santé\nde chaque enfant"],
            ['key' => 'hero_title_en', 'value' => "Together for the health\nof every child"],
            ['key' => 'hero_subtitle_fr', 'value' => "ONG béninoise engagée depuis 2012 pour la protection et le bien-être des enfants en situation de précarité."],
            ['key' => 'hero_subtitle_en', 'value' => "Beninese NGO committed since 2012 to protecting and supporting children in precarious situations."],
            ['key' => 'donorbox_campaign_url', 'value' => 'https://donorbox.org/ong-infentil'],
            ['key' => 'footer_text_fr', 'value' => "Ensemble, construisons un Bénin où chaque enfant a accès aux soins et à l'éducation."],
            ['key' => 'footer_text_en', 'value' => "Together, let's build a Benin where every child has access to healthcare and education."],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
