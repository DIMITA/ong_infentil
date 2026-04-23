@extends('layouts.app')
@section('title', $event->getTitle())
@section('content')
<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1 text-white/60 hover:text-white text-sm mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('app.back') }}
        </a>
        @if($event->isUpcoming())
        <div class="mb-4" x-data="countdown('{{ $event->date->toIso8601String() }}')">
            <div class="inline-flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 text-white font-mono">
                <span class="text-white/60 text-sm">{{ app()->getLocale() === 'fr' ? 'Dans' : 'In' }}</span>
                <span><span class="text-2xl font-bold" x-text="days">--</span>j</span>
                <span><span class="text-2xl font-bold" x-text="hours">--</span>h</span>
                <span><span class="text-2xl font-bold" x-text="minutes">--</span>m</span>
                <span><span class="text-2xl font-bold" x-text="seconds">--</span>s</span>
            </div>
        </div>
        @endif
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4">{{ $event->getTitle() }}</h1>
        <div class="flex flex-wrap gap-4 text-white/70 text-sm">
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $event->date->translatedFormat('d F Y') }}
            </span>
            @if($event->location)
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                {{ $event->location }}
            </span>
            @endif
        </div>
    </div>
</div>
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($event->getFirstMediaUrl('cover'))
        <img src="{{ $event->getFirstMediaUrl('cover', 'hero') }}" alt="{{ $event->getTitle() }}"
             class="w-full rounded-2xl mb-10 shadow-lg">
        @endif
        <div class="prose prose-lg max-w-none text-gray-700">
            {!! nl2br(e($event->getDescription())) !!}
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
function countdown(targetDate) {
    return {
        days:'--',hours:'--',minutes:'--',seconds:'--',target:new Date(targetDate),
        init(){this.update();setInterval(()=>this.update(),1000);},
        update(){const d=this.target-new Date();if(d<=0){this.days=this.hours=this.minutes=this.seconds='00';return;}this.days=String(Math.floor(d/86400000)).padStart(2,'0');this.hours=String(Math.floor((d%86400000)/3600000)).padStart(2,'0');this.minutes=String(Math.floor((d%3600000)/60000)).padStart(2,'0');this.seconds=String(Math.floor((d%60000)/1000)).padStart(2,'0');}
    }
}
</script>
@endpush
