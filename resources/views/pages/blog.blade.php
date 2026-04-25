@extends('layouts.app')

@section('title', __('blog.title'))
@section('meta_description', __('blog.subtitle'))

@section('content')

{{-- Page header --}}
<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ __('blog.title') }}</h1>
        <p class="text-white/70 text-lg">{{ __('blog.subtitle') }}</p>
    </div>
</div>

{{-- Category filter --}}
<div class="bg-white border-b border-gray-100 sticky top-16 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 overflow-x-auto">
        <div class="flex gap-2 min-w-max">
            <a href="{{ route('blog.index') }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ !request('category') ? 'bg-[#1B5E20] text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-[#1B5E20] hover:text-[#1B5E20]' }}">
                {{ __('blog.all_categories') }}
            </a>
            @foreach($categories as $key => $label)
            <a href="{{ route('blog.index', ['category' => $key]) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('category') === $key ? 'bg-[#1B5E20] text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-[#1B5E20] hover:text-[#1B5E20]' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<section class="py-16 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($posts->isEmpty())
            <div class="text-center py-24 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <p class="text-lg">{{ __('blog.no_posts') }}</p>
            </div>
        @else

        {{-- Featured article (first page only, no filter) --}}
        @if($featured && $posts->currentPage() === 1 && !request('category'))
        <div class="mb-14" x-data x-intersect="$el.classList.add('animate-fade-in-up')">
            <div class="text-xs font-semibold uppercase tracking-widest text-[#C17D3C] mb-4">{{ __('blog.featured') }}</div>
            <a href="{{ route('blog.show', $featured->slug) }}"
               class="group grid md:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-xl bg-white hover:shadow-2xl transition-shadow duration-300">
                {{-- Image --}}
                <div class="relative h-64 md:h-auto overflow-hidden">
                    @if($featured->hasMedia('cover'))
                        <img src="{{ $featured->getFirstMediaUrl('cover', 'hero') }}"
                             alt="{{ $featured->getTitle() }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#1B5E20] to-[#2d7a35] flex items-center justify-center">
                            <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                {{-- Content --}}
                <div class="p-8 md:p-10 flex flex-col justify-center">
                    @if($featured->category)
                    <span class="inline-block text-xs font-semibold uppercase tracking-widest text-[#1B5E20] bg-[#1B5E20]/10 px-3 py-1 rounded-full mb-4 w-fit">
                        {{ \App\Models\Post::CATEGORIES[$featured->category] ?? $featured->category }}
                    </span>
                    @endif
                    <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-[#1B5E20] transition-colors leading-snug">
                        {{ $featured->getTitle() }}
                    </h2>
                    <p class="text-gray-500 leading-relaxed mb-6 line-clamp-3">{{ $featured->getExcerpt() }}</p>
                    <div class="flex items-center gap-4 text-sm text-gray-400">
                        <span>{{ $featured->author_name ?: 'Graines de vie' }}</span>
                        <span>&middot;</span>
                        <span>{{ $featured->published_at?->translatedFormat('j F Y') }}</span>
                        <span>&middot;</span>
                        <span>{{ $featured->getReadingTime() }} {{ __('blog.reading_time') }}</span>
                    </div>
                </div>
            </a>
        </div>
        @endif

        {{-- Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            @if($post->id === $featured?->id && $posts->currentPage() === 1 && !request('category'))
                @continue
            @endif
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 flex flex-col"
                     x-data x-intersect="$el.classList.add('animate-fade-in-up')">
                {{-- Cover --}}
                <a href="{{ route('blog.show', $post->slug) }}" class="block relative h-48 overflow-hidden">
                    @if($post->hasMedia('cover'))
                        <img src="{{ $post->getFirstMediaUrl('cover', 'card') }}"
                             alt="{{ $post->getTitle() }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#1B5E20]/80 to-[#2d7a35] flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif
                    @if($post->category)
                    <span class="absolute top-3 left-3 text-xs font-semibold uppercase tracking-wide text-white bg-[#1B5E20]/80 backdrop-blur-sm px-2.5 py-1 rounded-full">
                        {{ \App\Models\Post::CATEGORIES[$post->category] ?? $post->category }}
                    </span>
                    @endif
                </a>
                {{-- Body --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-display text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-[#1B5E20] transition-colors">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->getTitle() }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3 flex-1">{{ $post->getExcerpt() }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-400 mt-auto pt-4 border-t border-gray-100">
                        <span>{{ $post->author_name ?: 'Graines de vie' }}</span>
                        <div class="flex items-center gap-2">
                            <span>{{ $post->published_at?->translatedFormat('j M Y') }}</span>
                            <span>&middot;</span>
                            <span>{{ $post->getReadingTime() }} min</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $posts->appends(request()->query())->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection
