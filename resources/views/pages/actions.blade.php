@extends('layouts.app')

@section('title', __('app.actions'))

@section('content')

<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ __('app.actions') }}</h1>
        <p class="text-white/70 text-lg">{{ app()->getLocale() === 'fr' ? 'Nos interventions sur le terrain au Bénin' : 'Our field interventions in Benin' }}</p>
    </div>
</div>

<section class="py-16 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Category filter -->
        <div class="flex flex-wrap gap-2 mb-10">
            <a href="{{ route('actions.index') }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ !$category ? 'bg-[#1B5E20] text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-[#1B5E20] hover:text-[#1B5E20]' }}">
                {{ __('app.all_categories') }}
            </a>
            @foreach($categories as $key => $label)
            <a href="{{ route('actions.index', ['category' => $key]) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ $category === $key ? 'bg-[#1B5E20] text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-[#1B5E20] hover:text-[#1B5E20]' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        @if($actions->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($actions as $action)
            <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 group hover:shadow-lg transition-all duration-300">
                <!-- Cover -->
                <div class="aspect-video overflow-hidden bg-[#1B5E20]/10 relative">
                    @if($action->getFirstMediaUrl('cover'))
                    <img src="{{ $action->getFirstMediaUrl('cover', 'thumb') }}" alt="{{ $action->getTitle() }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-[#1B5E20]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    @if($action->category)
                    <div class="absolute top-3 left-3">
                        <span class="bg-[#1B5E20] text-white text-xs font-medium px-3 py-1 rounded-full">
                            {{ $categories[$action->category] ?? $action->category }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-6">
                    @if($action->date)
                    <p class="text-xs text-gray-400 mb-2">{{ $action->date->translatedFormat('d F Y') }}</p>
                    @endif
                    <h2 class="font-display text-lg font-bold text-[#1A1A1A] mb-2 group-hover:text-[#1B5E20] transition-colors line-clamp-2">
                        {{ $action->getTitle() }}
                    </h2>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $action->getDescription() }}</p>
                    @if($action->slug)
                    <a href="{{ route('actions.show', $action->slug) }}"
                       class="inline-flex items-center gap-1 text-[#1B5E20] text-sm font-semibold hover:gap-2 transition-all">
                        {{ __('app.read_more') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-10">{{ $actions->withQueryString()->links() }}</div>
        @else
        <div class="text-center py-20">
            <p class="text-gray-400 text-lg">{{ __('app.no_results') }}</p>
        </div>
        @endif
    </div>
</section>

@endsection
