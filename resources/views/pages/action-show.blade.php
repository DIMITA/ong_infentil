@extends('layouts.app')
@section('title', $action->getTitle())
@section('content')
<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('actions.index') }}" class="inline-flex items-center gap-1 text-white/60 hover:text-white text-sm mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('app.back') }}
        </a>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4">{{ $action->getTitle() }}</h1>
        @if($action->date)
        <p class="text-white/70 text-sm">{{ $action->date->translatedFormat('d F Y') }}</p>
        @endif
    </div>
</div>
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($action->getFirstMediaUrl('cover'))
        <img src="{{ $action->getFirstMediaUrl('cover', 'thumb') }}" alt="{{ $action->getTitle() }}"
             class="w-full rounded-2xl mb-10 shadow-lg">
        @endif
        <div class="prose prose-lg max-w-none text-gray-700 mb-12">
            {!! nl2br(e($action->getDescription())) !!}
        </div>

        <!-- Gallery -->
        @php $gallery = $action->getMedia('gallery'); @endphp
        @if($gallery->count())
        <h2 class="font-display text-2xl font-bold text-[#1A1A1A] mb-6">{{ app()->getLocale() === 'fr' ? 'Galerie photos' : 'Photo gallery' }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($gallery as $media)
            <div class="aspect-square overflow-hidden rounded-xl">
                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $action->getTitle() }}"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
