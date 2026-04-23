@extends('layouts.app')

@section('title', $post->getTitle())
@section('meta_description', $post->getMetaDescription())

@section('content')

{{-- Hero --}}
<div class="relative bg-[#1B5E20] pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10"
         style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");">
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('blog.index') }}"
           class="inline-flex items-center gap-2 text-white/60 hover:text-white text-sm mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('blog.back') }}
        </a>

        @if($post->category)
        <span class="inline-block text-xs font-semibold uppercase tracking-widest text-[#C17D3C] bg-[#C17D3C]/10 border border-[#C17D3C]/30 px-3 py-1 rounded-full mb-4">
            {{ \App\Models\Post::CATEGORIES[$post->category] ?? $post->category }}
        </span>
        @endif

        <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
            {{ $post->getTitle() }}
        </h1>

        <div class="flex flex-wrap items-center gap-4 text-white/60 text-sm">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $post->author_name ?: 'ONG Infentil' }}
            </span>
            <span>&middot;</span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $post->published_at?->translatedFormat('j F Y') }}
            </span>
            <span>&middot;</span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $post->getReadingTime() }} {{ __('blog.reading_time') }}
            </span>
        </div>
    </div>
</div>

{{-- Cover image --}}
@if($post->hasMedia('cover'))
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10 mb-0">
    <div class="rounded-2xl overflow-hidden shadow-2xl aspect-video">
        <img src="{{ $post->getFirstMediaUrl('cover', 'hero') }}"
             alt="{{ $post->getTitle() }}"
             class="w-full h-full object-cover">
    </div>
</div>
@endif

{{-- Article body --}}
<div class="bg-[#FAFAF7] py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-[1fr_auto] gap-12 items-start">

            {{-- Main content --}}
            <article>
                @if($post->getExcerpt() && $post->getContent())
                <p class="text-xl text-gray-600 leading-relaxed mb-10 pb-10 border-b border-gray-200 font-medium">
                    {{ $post->getExcerpt() }}
                </p>
                @endif

                <div class="prose prose-lg prose-green max-w-none
                            prose-headings:font-display prose-headings:text-gray-900
                            prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                            prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                            prose-p:text-gray-700 prose-p:leading-relaxed
                            prose-a:text-[#1B5E20] prose-a:font-medium hover:prose-a:text-[#C17D3C]
                            prose-strong:text-gray-900
                            prose-blockquote:border-l-[#C17D3C] prose-blockquote:bg-[#C17D3C]/5 prose-blockquote:py-1 prose-blockquote:not-italic
                            prose-blockquote:text-gray-700 prose-blockquote:rounded-r-lg
                            prose-code:text-[#1B5E20] prose-code:bg-[#1B5E20]/10 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-sm
                            prose-pre:bg-gray-900 prose-pre:rounded-xl
                            prose-img:rounded-xl prose-img:shadow-lg
                            prose-ul:text-gray-700 prose-ol:text-gray-700
                            prose-li:my-1
                            prose-table:w-full prose-th:bg-[#1B5E20] prose-th:text-white prose-th:p-3 prose-td:p-3 prose-td:border prose-td:border-gray-200">
                    {!! $post->getContent() !!}
                </div>

                {{-- Share --}}
                <div class="mt-12 pt-8 border-t border-gray-200 flex flex-wrap items-center gap-4">
                    <span class="text-sm font-semibold text-gray-500 uppercase tracking-wide">{{ __('blog.share') }}</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1877F2] text-white text-sm font-medium px-4 py-2 rounded-full hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->getTitle()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-black text-white text-sm font-medium px-4 py-2 rounded-full hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                        X / Twitter
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#0A66C2] text-white text-sm font-medium px-4 py-2 rounded-full hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </article>

            {{-- Sticky sidebar --}}
            <aside class="hidden lg:block w-64 sticky top-24">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-display font-bold text-gray-900 mb-4 text-base">{{ __('blog.related') }}</h3>
                    @forelse($related as $r)
                    <a href="{{ route('blog.show', $r->slug) }}" class="group block mb-4 last:mb-0">
                        <div class="flex gap-3">
                            @if($r->hasMedia('cover'))
                            <img src="{{ $r->getFirstMediaUrl('cover', 'thumb') }}"
                                 alt="{{ $r->getTitle() }}"
                                 class="w-16 h-12 rounded-lg object-cover flex-shrink-0">
                            @else
                            <div class="w-16 h-12 rounded-lg bg-[#1B5E20]/10 flex-shrink-0 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#1B5E20]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-800 line-clamp-2 group-hover:text-[#1B5E20] transition-colors leading-snug">
                                    {{ $r->getTitle() }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $r->published_at?->translatedFormat('j M Y') }}</p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400">—</p>
                    @endforelse
                </div>

                {{-- CTA donate --}}
                <div class="bg-gradient-to-br from-[#1B5E20] to-[#2d7a35] rounded-2xl p-6 mt-4 text-white">
                    <p class="font-display font-bold text-lg mb-2">{{ app()->getLocale() === 'fr' ? 'Soutenez-nous' : 'Support us' }}</p>
                    <p class="text-white/70 text-sm mb-4">{{ app()->getLocale() === 'fr' ? 'Chaque don aide un enfant au Bénin.' : 'Every donation helps a child in Benin.' }}</p>
                    <a href="{{ route('donate') }}"
                       class="block text-center bg-[#C17D3C] hover:bg-[#a06830] text-white font-semibold text-sm px-4 py-2.5 rounded-full transition-colors">
                        {{ app()->getLocale() === 'fr' ? 'Faire un don' : 'Donate now' }}
                    </a>
                </div>
            </aside>

        </div>
    </div>
</div>

{{-- Related articles (mobile) --}}
@if($related->isNotEmpty())
<section class="bg-white py-12 lg:hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-2xl font-bold text-gray-900 mb-6">{{ __('blog.related') }}</h2>
        <div class="grid sm:grid-cols-3 gap-6">
            @foreach($related as $r)
            <a href="{{ route('blog.show', $r->slug) }}" class="group bg-[#FAFAF7] rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                @if($r->hasMedia('cover'))
                <img src="{{ $r->getFirstMediaUrl('cover', 'card') }}"
                     alt="{{ $r->getTitle() }}"
                     class="w-full h-36 object-cover">
                @else
                <div class="w-full h-36 bg-[#1B5E20]/10"></div>
                @endif
                <div class="p-4">
                    <p class="text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-[#1B5E20] transition-colors">{{ $r->getTitle() }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $r->published_at?->translatedFormat('j M Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
