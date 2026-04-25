@extends('layouts.app')

@section('title', __('app.about'))

@section('content')

{{-- Hero --}}
<div class="bg-gradient-to-br from-[#1B5E20] to-[#2d7a35] pt-32 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/svg%3E\");"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#C17D3C] text-xs font-semibold uppercase tracking-widest mb-4">
            {{ app()->getLocale() === 'fr' ? 'Qui sommes-nous' : 'Who we are' }}
        </span>
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mb-4">{{ __('app.about') }}</h1>
        <p class="text-white/70 text-xl max-w-2xl mx-auto">
            {{ app()->getLocale() === 'fr'
                ? 'Notre histoire, nos valeurs, notre mission au Bénin depuis 2015.'
                : 'Our story, values, and mission in Benin since 2015.' }}
        </p>
    </div>
</div>

{{-- Notre histoire --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div>
                <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">
                    {{ app()->getLocale() === 'fr' ? 'Notre histoire' : 'Our story' }}
                </span>
                <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-2 mb-6">
                    {{ app()->getLocale() === 'fr' ? 'Née à Ouidah, au cœur du terrain' : 'Born in Ouidah, at the heart of the field' }}
                </h2>
                <div class="space-y-5 text-gray-600 leading-relaxed">
                    @if(app()->getLocale() === 'fr')
                    <p>
                        Graines de vie est une association humanitaire locale fondée dans la région d'Ouidah, au sud du Bénin. Née d'un constat simple — des enfants vulnérables, orphelins ou en grande précarité, sans filet de sécurité — elle a choisi de construire ce filet, brique par brique.
                    </p>
                    <p>
                        Nos actions s'articulent autour de trois axes concrets : accompagner les enfants dans leur scolarité, assurer leur alimentation à la cantine de l'école primaire d'Adjaglo, et coordonner des missions médicales bénévoles dans les villages isolés de la brousse environnante.
                    </p>
                    <p>
                        Graines de vie accueille un orphelinat et une pouponnière, et travaille en étroite collaboration avec des équipes de bénévoles médicaux internationaux — médecins, infirmières et sages-femmes — qui viennent deux fois par an consulter des centaines de patients dans les zones où il n'y a pas de structure de santé.
                    </p>
                    <p>
                        Ce que nous faisons n'est pas spectaculaire. C'est du quotidien, du patient, du durable. Planter une graine, c'est croire en ce qu'elle deviendra.
                    </p>
                    @else
                    <p>
                        Graines de vie is a local humanitarian association founded in the Ouidah region, southern Benin. Born from a simple observation — orphaned and at-risk children with no safety net — it chose to build that safety net, brick by brick.
                    </p>
                    <p>
                        Our work focuses on three concrete axes: supporting children in their schooling, ensuring their daily meals at the Adjaglo primary school canteen, and coordinating volunteer medical missions in isolated bush villages.
                    </p>
                    <p>
                        Graines de vie runs an orphanage and a nursery, and works closely with international volunteer medical teams — doctors, nurses and midwives — who come twice a year to consult hundreds of patients in areas with no health infrastructure.
                    </p>
                    <p>
                        What we do is not spectacular. It is daily, patient, lasting work. To plant a seed is to believe in what it will become.
                    </p>
                    @endif
                </div>
            </div>

            {{-- Values --}}
            <div class="space-y-6">
                <div class="bg-[#FAFAF7] rounded-3xl p-8">
                    <h3 class="font-display text-xl font-bold text-[#1A1A1A] mb-6">
                        {{ app()->getLocale() === 'fr' ? 'Nos valeurs' : 'Our values' }}
                    </h3>
                    @php
                    $values = app()->getLocale() === 'fr' ? [
                        ['🌱', 'Enracinement', 'Nous travaillons avec les communautés, pas pour elles. Chaque intervention naît d\'un dialogue local.'],
                        ['❤️', 'Dignité', 'Chaque enfant, quelle que soit son origine ou sa situation, mérite des soins et de l\'attention.'],
                        ['🔍', 'Transparence', 'Nos comptes, nos résultats et nos erreurs sont partagés chaque année avec nos donateurs et partenaires.'],
                        ['🤝', 'Durabilité', 'Nous formons, nous transférons, nous partons — pour que les acquis perdurent sans nous.'],
                    ] : [
                        ['🌱', 'Rootedness', 'We work with communities, not for them. Every intervention begins with local dialogue.'],
                        ['❤️', 'Dignity', 'Every child, regardless of background or situation, deserves care and attention.'],
                        ['🔍', 'Transparency', 'Our accounts, results, and mistakes are shared every year with our donors and partners.'],
                        ['🤝', 'Sustainability', 'We train, we transfer, we leave — so that the gains last without us.'],
                    ];
                    @endphp
                    <div class="space-y-5">
                        @foreach($values as $value)
                        <div class="flex gap-4">
                            <span class="text-2xl">{{ $value[0] }}</span>
                            <div>
                                <p class="font-semibold text-[#1A1A1A] text-sm">{{ $value[1] }}</p>
                                <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">{{ $value[2] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- 3 pillars --}}
                <div class="grid grid-cols-3 gap-3">
                    @php
                    $pillars = app()->getLocale() === 'fr'
                        ? [['🏥','Santé','Cliniques mobiles & vaccinations'],['🥗','Nutrition','Lutte contre la malnutrition infantile'],['📚','Éducation','Bourses & accès à l\'école']]
                        : [['🏥','Health','Mobile clinics & vaccinations'],['🥗','Nutrition','Fighting child malnutrition'],['📚','Education','Scholarships & school access']];
                    @endphp
                    @foreach($pillars as $p)
                    <div class="bg-[#1B5E20]/5 rounded-2xl p-4 text-center">
                        <div class="text-3xl mb-2">{{ $p[0] }}</div>
                        <p class="font-bold text-[#1B5E20] text-sm">{{ $p[1] }}</p>
                        <p class="text-gray-500 text-xs mt-1 leading-tight">{{ $p[2] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Reportages / Vidéos --}}
<section class="py-20 bg-[#FAFAF7]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest">
                {{ app()->getLocale() === 'fr' ? 'Ils sont venus voir' : 'They came to see' }}
            </span>
            <h2 class="font-display text-4xl font-bold text-[#1A1A1A] mt-2">
                {{ app()->getLocale() === 'fr' ? 'Reportages sur notre travail' : 'Reports on our work' }}
            </h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">
                {{ app()->getLocale() === 'fr'
                    ? 'Des journalistes et documentaristes ont suivi nos équipes sur le terrain au Bénin.'
                    : 'Journalists and documentary filmmakers have followed our teams in the field in Benin.' }}
            </p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="rounded-2xl overflow-hidden shadow-lg bg-white">
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
                    <p class="font-display font-bold text-[#1A1A1A]">Graines de vie, graines d'espoir</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ app()->getLocale() === 'fr'
                            ? 'Documentaire sur les actions de l\'ONG au Bénin.'
                            : 'Documentary about the NGO\'s actions in Benin.' }}
                    </p>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg bg-white">
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
                    <p class="font-display font-bold text-[#1A1A1A]">Ce que l'Afrique m'a soufflé</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ app()->getLocale() === 'fr'
                            ? 'Documentaire réalisé au Bénin par des journalistes en herbe.'
                            : 'Documentary made in Benin by budding journalists.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Partners --}}
@if($partners->count())
<section class="py-16 bg-white">
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

{{-- CTA Donate --}}
<section class="py-20 bg-[#1B5E20]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#C17D3C] text-sm font-semibold uppercase tracking-widest mb-3">
            {{ app()->getLocale() === 'fr' ? 'Agir maintenant' : 'Take action now' }}
        </p>
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mb-4">
            {{ app()->getLocale() === 'fr' ? 'Chaque don est une graine plantée' : 'Every donation is a seed planted' }}
        </h2>
        <p class="text-white/70 mb-8">
            {{ app()->getLocale() === 'fr'
                ? '10€ financent une consultation médicale. 25€ nourrissent un enfant pendant un mois. 50€ couvrent une bourse scolaire trimestrielle.'
                : '€10 funds a medical consultation. €25 feeds a child for a month. €50 covers a term school scholarship.' }}
        </p>
        <a href="{{ route('donate') }}"
           class="inline-flex items-center gap-2 bg-[#C17D3C] hover:bg-[#a06830] text-white font-bold px-8 py-4 rounded-full text-lg transition-all hover:scale-105 shadow-2xl">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            {{ __('home.cta_donate') }}
        </a>
    </div>
</section>

@endsection
