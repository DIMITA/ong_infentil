@extends('layouts.app')

@section('title', __('app.events'))

@section('content')

<!-- Page Hero -->
<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ __('app.events') }}</h1>
        <p class="text-white/70 text-lg">{{ app()->getLocale() === 'fr' ? 'Rejoignez-nous lors de nos prochaines actions' : 'Join us at our upcoming events' }}</p>
    </div>
</div>

<!-- Upcoming Events -->
@if($upcomingEvents->count())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl font-bold text-[#1A1A1A] mb-8">
            {{ __('app.upcoming') }}
            <span class="text-[#C17D3C]">({{ $upcomingEvents->count() }})</span>
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($upcomingEvents as $event)
            <div class="bg-[#FAFAF7] rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all group">
                <!-- Countdown bar -->
                <div class="bg-[#1B5E20] px-6 py-4" x-data="countdown('{{ $event->date->toIso8601String() }}')">
                    <div class="flex items-center justify-between">
                        <span class="text-white/70 text-xs uppercase tracking-widest">{{ app()->getLocale() === 'fr' ? 'Compte à rebours' : 'Countdown' }}</span>
                        <div class="flex items-center gap-3 text-white font-mono text-sm">
                            <span><span class="text-xl font-bold" x-text="days">--</span>j</span>
                            <span class="text-white/30">:</span>
                            <span><span class="text-xl font-bold" x-text="hours">--</span>h</span>
                            <span class="text-white/30">:</span>
                            <span><span class="text-xl font-bold" x-text="minutes">--</span>m</span>
                            <span class="text-white/30">:</span>
                            <span><span class="text-xl font-bold" x-text="seconds">--</span>s</span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if($event->getFirstMediaUrl('cover'))
                    <img src="{{ $event->getFirstMediaUrl('cover', 'thumb') }}" alt="{{ $event->getTitle() }}"
                         class="w-full h-40 object-cover rounded-xl mb-4">
                    @endif
                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->date->translatedFormat('d F Y — H\hi') }}
                        </span>
                        @if($event->location)
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $event->location }}
                        </span>
                        @endif
                    </div>
                    <h3 class="font-display text-xl font-bold text-[#1A1A1A] mb-2 group-hover:text-[#1B5E20] transition-colors">
                        {{ $event->getTitle() }}
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $event->getDescription() }}</p>
                    @if($event->slug)
                    <a href="{{ route('events.show', $event->slug) }}"
                       class="inline-flex items-center gap-1 bg-[#1B5E20] text-white text-sm font-semibold px-4 py-2 rounded-full hover:bg-[#155220] transition-colors">
                        {{ __('app.read_more') }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Past Events -->
@if($pastEvents->count())
<section class="py-16 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl font-bold text-[#1A1A1A] mb-8">{{ __('app.completed') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pastEvents as $event)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 group hover:shadow-md transition-all relative">
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">{{ __('app.completed') }}</span>
                </div>
                @if($event->getFirstMediaUrl('cover'))
                <div class="relative overflow-hidden h-40">
                    <img src="{{ $event->getFirstMediaUrl('cover', 'thumb') }}" alt="{{ $event->getTitle() }}"
                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                </div>
                @else
                <div class="h-2 bg-gray-200"></div>
                @endif
                <div class="p-5">
                    <p class="text-xs text-gray-400 mb-2">{{ $event->date->translatedFormat('d F Y') }}</p>
                    <h3 class="font-display text-lg font-bold text-gray-700 mb-1 group-hover:text-[#1B5E20] transition-colors line-clamp-2">
                        {{ $event->getTitle() }}
                    </h3>
                    @if($event->location)
                    <p class="text-xs text-gray-400">📍 {{ $event->location }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{ $pastEvents->links() }}
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
function countdown(targetDate) {
    return {
        days: '--', hours: '--', minutes: '--', seconds: '--',
        target: new Date(targetDate),
        init() { this.update(); setInterval(() => this.update(), 1000); },
        update() {
            const diff = this.target - new Date();
            if (diff <= 0) { this.days = this.hours = this.minutes = this.seconds = '00'; return; }
            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        }
    }
}
</script>
@endpush
