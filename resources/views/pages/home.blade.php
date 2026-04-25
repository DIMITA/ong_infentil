@extends('layouts.app')

@section('title', app()->getLocale() === 'fr' ? 'Accueil' : 'Home')

@section('content')

{{-- HERO --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#1B5E20] via-[#2d7a35] to-[#1a4a1e]"></div>
    <!-- Pattern overlay -->
    <div class="absolute inset-0 opacity-10"
         style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");">
    </div>
    <!-- Gradient bottom fade -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#FAFAF7] to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24 pb-16">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-xs font-medium px-4 py-1.5 rounded-full border border-white/20 mb-8 animate-fade-in-up">
            <span class="w-2 h-2 bg-[#C17D3C] rounded-full animate-pulse"></span>
            {{ app()->getLocale() === 'fr' ? 'ONG accréditée · Bénin' : 'Accredited NGO · Benin' }}
        </div>

        <!-- Title -->
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
            {!! nl2br(e(app()->getLocale() === 'fr' ? $settings['hero_title_fr'] : $settings['hero_title_en'])) !!}
        </h1>

        <!-- Subtitle -->
        <p class="text-white/70 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s">
            {{ app()->getLocale() === 'fr' ? $settings['hero_subtitle_fr'] : $settings['hero_subtitle_en'] }}
        </p>

        <!-- CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 0.3s">
            <a href="{{ route('donate') }}"
               class="inline-flex items-center gap-2 bg-[#C17D3C] hover:bg-[#a06830] text-white font-semibold px-8 py-4 rounded-full text-lg transition-all hover:scale-105 shadow-2xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                {{ __('home.cta_donate') }}
            </a>
            <a href="{{ route('about') }}"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold px-8 py-4 rounded-full text-lg border border-white/30 transition-all">
                {{ app()->getLocale() === 'fr' ? 'Découvrir notre mission' : 'Discover our mission' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <!-- Scroll indicator -->
        <div class="mt-16 animate-bounce">
            <svg class="w-6 h-6 text-white/40 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="py-16 bg-white" x-data="stats()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($stats as $stat)
            <div class="text-center"
                 x-intersect.once="animateValue($el, {{ $stat->value }})"
                 data-target="{{ $stat->value }}">
                <div class="text-4xl sm:text-5xl font-display font-bold text-[#1B5E20] mb-2">
                    <span class="counter">0</span>
                    <span class="text-[#C17D3C]">+</span>
                </div>
                <p class="text-gray-600 text-sm font-medium">{{ $stat->getLabel() }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WAVE separator --}}
<div class="bg-white overflow-hidden">
    <svg viewBox="0 0 1440 80" class="w-full text-[#FAFAF7] fill-current" preserveAspectRatio="none" style="height:60px">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z"/>
    </svg>
</div>

{{-- MISSION --}}
<section class="py-20 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">{{ app()->getLocale() === 'fr' ? 'Ce que nous faisons' : 'What we do' }}</span>
            <h2 class="font-display text-4xl sm:text-5xl font-bold text-[#1A1A1A] mt-2">{{ __('home.mission_title') }}</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">{{ __('home.mission_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $missions = [
                ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => __('home.mission_health'), 'text' => __('home.mission_health_text'), 'color' => 'bg-red-50 text-red-600'],
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => __('home.mission_education'), 'text' => __('home.mission_education_text'), 'color' => 'bg-blue-50 text-blue-600'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => __('home.mission_protection'), 'text' => __('home.mission_protection_text'), 'color' => 'bg-green-50 text-[#1B5E20]'],
            ];
            @endphp
            @foreach($missions as $i => $mission)
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow border border-gray-100 group"
                 style="animation-delay: {{ $i * 0.1 }}s">
                <div class="w-14 h-14 {{ $mission['color'] }} rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $mission['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-display text-xl font-bold text-[#1A1A1A] mb-3">{{ $mission['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $mission['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- UPCOMING EVENTS --}}
@if($upcomingEvents->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">{{ __('home.upcoming_events') }}</span>
                <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-1">{{ __('home.upcoming_events_subtitle') }}</h2>
            </div>
            <a href="{{ route('events.index') }}" class="hidden sm:inline-flex items-center gap-2 text-[#1B5E20] font-semibold hover:gap-3 transition-all">
                {{ __('app.see_all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upcomingEvents as $event)
            <div class="bg-[#FAFAF7] rounded-2xl overflow-hidden group hover:shadow-lg transition-all duration-300 border border-gray-100">
                <!-- Countdown -->
                <div class="bg-[#1B5E20] px-5 py-3" x-data="countdown('{{ $event->date->toIso8601String() }}')">
                    <div class="flex items-center gap-4 text-white text-sm font-mono">
                        <div class="text-center">
                            <div class="text-2xl font-bold" x-text="days">--</div>
                            <div class="text-white/60 text-xs">{{ app()->getLocale() === 'fr' ? 'jours' : 'days' }}</div>
                        </div>
                        <div class="text-white/40 text-xl">:</div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" x-text="hours">--</div>
                            <div class="text-white/60 text-xs">h</div>
                        </div>
                        <div class="text-white/40 text-xl">:</div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" x-text="minutes">--</div>
                            <div class="text-white/60 text-xs">min</div>
                        </div>
                        <div class="text-white/40 text-xl">:</div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" x-text="seconds">--</div>
                            <div class="text-white/60 text-xs">sec</div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->date->translatedFormat('d F Y') }}
                        @if($event->location)
                        <span class="text-gray-300">·</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $event->location }}
                        @endif
                    </div>
                    <h3 class="font-display text-lg font-bold text-[#1A1A1A] mb-3 group-hover:text-[#1B5E20] transition-colors line-clamp-2">
                        {{ $event->getTitle() }}
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $event->getDescription() }}</p>
                    @if($event->slug)
                    <a href="{{ route('events.show', $event->slug) }}"
                       class="inline-flex items-center gap-1 text-[#1B5E20] text-sm font-semibold hover:gap-2 transition-all">
                        {{ __('app.read_more') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="py-20 bg-[#1B5E20] relative overflow-hidden">
    <div class="absolute inset-0 opacity-5"
         style="background-image: url(\"data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='20' cy='20' r='2'/%3E%3C/g%3E%3C/svg%3E\")">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">{{ __('home.testimonials_title') }}</span>
            <h2 class="font-display text-4xl font-bold text-white mt-2">{{ __('home.testimonials_subtitle') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials->take(3) as $testimonial)
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 text-[#C17D3C]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    @endfor
                </div>
                <p class="text-white/80 text-sm leading-relaxed mb-5 italic">"{{ $testimonial->getText() }}"</p>
                <div class="flex items-center gap-3">
                    @if($testimonial->getFirstMediaUrl('photo'))
                    <img src="{{ $testimonial->getFirstMediaUrl('photo', 'thumb') }}" alt="{{ $testimonial->name }}"
                         class="w-10 h-10 rounded-full object-cover border-2 border-white/30">
                    @else
                    <div class="w-10 h-10 rounded-full bg-[#C17D3C] flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $testimonial->name }}</p>
                        @if($testimonial->role)
                        <p class="text-white/50 text-xs">{{ $testimonial->role }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- PARTNERS --}}
@if($partners->count())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm font-semibold text-gray-400 uppercase tracking-widest mb-10">{{ __('home.partners_title') }}</p>
        <div class="flex flex-wrap items-center justify-center gap-8">
            @foreach($partners as $partner)
            <div class="grayscale hover:grayscale-0 transition-all opacity-60 hover:opacity-100">
                @if($partner->getFirstMediaUrl('logo'))
                    @if($partner->url)
                    <a href="{{ $partner->url }}" target="_blank" rel="noopener">
                    @endif
                    <img src="{{ $partner->getFirstMediaUrl('logo', 'thumb') }}" alt="{{ $partner->name }}"
                         class="h-12 w-auto object-contain">
                    @if($partner->url)</a>@endif
                @else
                    <span class="text-gray-500 text-sm font-medium px-4 py-2 border border-gray-200 rounded-lg">{{ $partner->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- NOS 3 PILIERS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">
                {{ app()->getLocale() === 'fr' ? 'Notre approche' : 'Our approach' }}
            </span>
            <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-2">
                {{ app()->getLocale() === 'fr' ? 'Trois piliers, une mission' : 'Three pillars, one mission' }}
            </h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @php
            $pillars = app()->getLocale() === 'fr' ? [
                [
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'label' => 'Santé',
                    'desc'  => 'Caravanes médicales mobiles, vaccinations, soins préventifs et suivi nutritionnel dans les villages les plus isolés du Bénin.',
                    'stat'  => '24 000 consultations',
                ],
                [
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'label' => 'Nutrition',
                    'desc'  => 'Centres communautaires de nutrition, distribution de compléments alimentaires et formation des mères à une alimentation adaptée.',
                    'stat'  => '8 400 enfants suivis',
                ],
                [
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'label' => 'Éducation',
                    'desc'  => "Bourses scolaires, fournitures, accès aux cantines et soutien aux familles pour maintenir les enfants à l'école toute l'année.",
                    'stat'  => '37 villages couverts',
                ],
            ] : [
                [
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'label' => 'Health',
                    'desc'  => 'Mobile medical caravans, vaccinations, preventive care and nutritional follow-up in the most isolated villages of Benin.',
                    'stat'  => '24,000 consultations',
                ],
                [
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'label' => 'Nutrition',
                    'desc'  => 'Community nutrition centres, distribution of food supplements and training mothers in appropriate feeding practices.',
                    'stat'  => '8,400 children monitored',
                ],
                [
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'label' => 'Education',
                    'desc'  => 'School scholarships, supplies, canteen access and family support to keep children in school all year long.',
                    'stat'  => '37 villages covered',
                ],
            ];
            @endphp
            @foreach($pillars as $i => $p)
            <div class="group relative bg-[#FAFAF7] rounded-3xl p-8 hover:bg-[#1B5E20] transition-colors duration-300 overflow-hidden"
                 x-data x-intersect="$el.classList.add('animate-fade-in-up')"
                 style="animation-delay: {{ $i * 100 }}ms">
                <div class="w-14 h-14 bg-[#1B5E20] group-hover:bg-white/20 rounded-2xl flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $p['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-[#1A1A1A] group-hover:text-white mb-3 transition-colors">{{ $p['label'] }}</h3>
                <p class="text-gray-600 group-hover:text-white/80 text-sm leading-relaxed mb-5 transition-colors">{{ $p['desc'] }}</p>
                <span class="inline-block text-xs font-semibold text-[#C17D3C] group-hover:text-[#f0a060] bg-[#C17D3C]/10 group-hover:bg-white/10 px-3 py-1 rounded-full transition-colors">
                    {{ $p['stat'] }}
                </span>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('actions.index') }}"
               class="inline-flex items-center gap-2 text-[#1B5E20] font-semibold hover:gap-3 transition-all">
                {{ app()->getLocale() === 'fr' ? 'Voir toutes nos actions' : 'See all our actions' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- REPORTAGES VIDÉO --}}
<section class="py-20 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">
                {{ app()->getLocale() === 'fr' ? 'Ils ont suivi nos équipes' : 'They followed our teams' }}
            </span>
            <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-2">
                {{ app()->getLocale() === 'fr' ? 'Reportages sur le terrain' : 'Field reports' }}
            </h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto text-sm">
                {{ app()->getLocale() === 'fr'
                    ? 'Des documentaristes ont accompagné nos équipes pour raconter ce que font les mots ne peuvent pas.'
                    : 'Filmmakers joined our teams to capture what words alone cannot convey.' }}
            </p>
        </div>
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                <div class="aspect-video">
                    <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/Y67vnHM3lPE"
                        title="Graines de vie, graines d'espoir"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-5">
                    <p class="font-display font-bold text-[#1A1A1A] text-lg">Graines de vie, graines d'espoir</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ app()->getLocale() === 'fr' ? 'Documentaire sur les actions terrain de l\'ONG au Bénin.' : 'Documentary on the NGO\'s field work in Benin.' }}
                    </p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                <div class="aspect-video">
                    <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/tjD3Gbs1C0g"
                        title="Ce que l'Afrique m'a soufflé"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-5">
                    <p class="font-display font-bold text-[#1A1A1A] text-lg">Ce que l'Afrique m'a soufflé</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ app()->getLocale() === 'fr' ? 'Un regard extérieur sur la mission de Graines de vie.' : 'An outside perspective on the Graines de vie mission.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gradient-to-br from-[#C17D3C] to-[#a06830] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"
         style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='30' cy='30' r='3'/%3E%3C/g%3E%3C/svg%3E\")">
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4">{{ __('home.cta_title') }}</h2>
        <p class="text-white/80 text-lg mb-10">{{ __('home.cta_text') }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}"
               class="inline-flex items-center gap-2 bg-white text-[#C17D3C] font-bold px-8 py-4 rounded-full text-lg hover:scale-105 transition-all shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                {{ __('home.cta_donate') }}
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 bg-transparent border-2 border-white/50 hover:border-white text-white font-semibold px-8 py-4 rounded-full text-lg transition-all">
                {{ __('home.cta_contact') }}
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function countdown(targetDate) {
    return {
        days: '--', hours: '--', minutes: '--', seconds: '--',
        target: new Date(targetDate),
        init() {
            this.update();
            setInterval(() => this.update(), 1000);
        },
        update() {
            const now = new Date();
            const diff = this.target - now;
            if (diff <= 0) { this.days = this.hours = this.minutes = this.seconds = '00'; return; }
            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        }
    }
}

function stats() {
    return {
        animateValue(el, target) {
            const counter = el.querySelector('.counter');
            if (!counter) return;
            let current = 0;
            const step = Math.ceil(target / 80);
            const timer = setInterval(() => {
                current = Math.min(current + step, target);
                counter.textContent = current.toLocaleString();
                if (current >= target) clearInterval(timer);
            }, 20);
        }
    }
}
</script>
@endpush
