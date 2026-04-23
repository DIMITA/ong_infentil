<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $stats = Stat::ordered()->get();
        $upcomingEvents = Event::active()->upcoming()->take(3)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $partners = Partner::active()->get();
        $settings = [
            'hero_title_fr' => Setting::get('hero_title_fr', "Ensemble pour la santé\nde chaque enfant"),
            'hero_title_en' => Setting::get('hero_title_en', "Together for the health\nof every child"),
            'hero_subtitle_fr' => Setting::get('hero_subtitle_fr', "ONG béninoise engagée pour la protection et le bien-être des enfants en situation de précarité."),
            'hero_subtitle_en' => Setting::get('hero_subtitle_en', "Beninese NGO committed to protecting and supporting children in precarious situations."),
        ];
        return view('pages.home', compact('stats', 'upcomingEvents', 'testimonials', 'partners', 'settings'));
    }
}
