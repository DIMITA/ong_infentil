@extends('layouts.app')

@section('title', __('app.about'))

@section('content')

<div class="bg-gradient-to-br from-[#1B5E20] to-[#2d7a35] pt-32 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/svg%3E\");"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mb-4">{{ __('app.about') }}</h1>
        <p class="text-white/70 text-xl">{{ app()->getLocale() === 'fr' ? 'Notre histoire, nos valeurs, notre équipe' : 'Our history, values, and team' }}</p>
    </div>
</div>

<!-- Story -->
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">{{ app()->getLocale() === 'fr' ? 'Notre histoire' : 'Our story' }}</span>
                <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-2 mb-6">
                    {{ app()->getLocale() === 'fr' ? 'Fondée en 2012 à Cotonou' : 'Founded in 2012 in Cotonou' }}
                </h2>
                <div class="prose prose-sm text-gray-600 space-y-4">
                    @if(app()->getLocale() === 'fr')
                    <p>ONG Infentil est née d'un constat simple : des milliers d'enfants béninois n'avaient pas accès aux soins de santé de base, à l'éducation, ni à une protection adéquate.</p>
                    <p>Fondée par un groupe de médecins, d'enseignants et d'acteurs sociaux engagés, notre organisation s'est rapidement développée pour toucher les zones les plus isolées du Bénin.</p>
                    <p>Aujourd'hui, grâce au soutien de nos partenaires internationaux et locaux, nous intervenons dans 48 zones pour assurer la santé, l'éducation et la protection de plus de 12 500 enfants.</p>
                    @else
                    <p>NGO Infentil was born from a simple observation: thousands of Beninese children lacked access to basic healthcare, education, and adequate protection.</p>
                    <p>Founded by a group of committed doctors, teachers and social workers, our organization quickly grew to reach the most isolated areas of Benin.</p>
                    <p>Today, with the support of our international and local partners, we work in 48 areas to ensure the health, education and protection of more than 12,500 children.</p>
                    @endif
                </div>
            </div>
            <div class="bg-[#FAFAF7] rounded-3xl p-8">
                <!-- Values -->
                <h3 class="font-display text-xl font-bold text-[#1A1A1A] mb-6">{{ app()->getLocale() === 'fr' ? 'Nos valeurs' : 'Our values' }}</h3>
                @php
                $values = app()->getLocale() === 'fr' ? [
                    ['Dignité', 'Chaque enfant mérite d\'être traité avec dignité et respect, sans distinction.'],
                    ['Solidarité', 'Nous croyons à la force du collectif et à la solidarité entre les peuples.'],
                    ['Transparence', 'Nos actions, nos finances et nos résultats sont rendus publics chaque année.'],
                    ['Impact', 'Chaque franc investi doit se traduire par un bénéfice mesurable pour les enfants.'],
                ] : [
                    ['Dignity', 'Every child deserves to be treated with dignity and respect, without distinction.'],
                    ['Solidarity', 'We believe in the power of community and solidarity between peoples.'],
                    ['Transparency', 'Our actions, finances and results are published publicly every year.'],
                    ['Impact', 'Every franc invested must translate into a measurable benefit for children.'],
                ];
                @endphp
                <div class="space-y-4">
                    @foreach($values as $value)
                    <div class="flex gap-3">
                        <div class="w-6 h-6 bg-[#1B5E20] rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-[#1A1A1A] text-sm">{{ $value[0] }}</p>
                            <p class="text-gray-500 text-xs mt-0.5">{{ $value[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners -->
@if($partners->count())
<section class="py-16 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="font-display text-3xl font-bold text-[#1A1A1A]">{{ __('home.partners_title') }}</h2>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-8">
            @foreach($partners as $partner)
            <div class="text-center">
                @if($partner->getFirstMediaUrl('logo'))
                    <img src="{{ $partner->getFirstMediaUrl('logo', 'thumb') }}" alt="{{ $partner->name }}" class="h-12 w-auto object-contain mx-auto mb-2">
                @endif
                <p class="text-xs text-gray-500">{{ $partner->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Donate -->
<section class="py-16 bg-[#1B5E20]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-3xl font-bold text-white mb-4">{{ __('home.cta_title') }}</h2>
        <a href="{{ route('donate') }}"
           class="inline-flex items-center gap-2 bg-[#C17D3C] hover:bg-[#a06830] text-white font-bold px-8 py-4 rounded-full text-lg transition-all hover:scale-105">
            {{ __('home.cta_donate') }}
        </a>
    </div>
</section>

@endsection
