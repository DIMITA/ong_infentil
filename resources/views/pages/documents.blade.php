@extends('layouts.app')

@section('title', __('app.documents'))

@section('content')

<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ __('app.documents') }}</h1>
        <p class="text-white/70 text-lg">{{ app()->getLocale() === 'fr' ? 'Rapports, bilans et communiqués officiels' : 'Reports, financial statements and press releases' }}</p>
    </div>
</div>

<section class="py-16 bg-[#FAFAF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Filters -->
        <form method="GET" action="{{ route('documents.index') }}" class="flex flex-wrap gap-3 mb-10">
            <select name="year"
                    onchange="this.form.submit()"
                    class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                <option value="">{{ __('app.all_years') }}</option>
                @foreach($years as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
            <select name="category"
                    onchange="this.form.submit()"
                    class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                <option value="">{{ __('app.all_categories') }}</option>
                @foreach($categories as $key => $label)
                <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </form>

        @if($documents->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($documents as $doc)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition-all group">
                <div class="flex items-start gap-4">
                    <!-- File icon -->
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-red-100 transition-colors">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <span class="text-xs font-medium text-[#1B5E20] bg-green-50 px-2 py-0.5 rounded-full">{{ $doc->year }}</span>
                            <span class="text-xs text-gray-400">{{ $categories[$doc->category] ?? $doc->category }}</span>
                        </div>
                        <h3 class="font-semibold text-[#1A1A1A] text-sm leading-snug mb-2 line-clamp-2">{{ $doc->title }}</h3>
                        @if($doc->description)
                        <p class="text-gray-500 text-xs line-clamp-2 mb-3">{{ $doc->description }}</p>
                        @endif
                        @if($doc->tags)
                        <div class="flex flex-wrap gap-1 mb-3">
                            @foreach($doc->tags as $tag)
                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">#{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                        <a href="{{ route('documents.download', $doc->id) }}"
                           class="inline-flex items-center gap-1.5 text-[#1B5E20] text-xs font-semibold hover:text-[#155220] transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            {{ __('app.download') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-10">{{ $documents->withQueryString()->links() }}</div>
        @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-gray-400 text-lg">{{ __('app.no_results') }}</p>
        </div>
        @endif
    </div>
</section>

@endsection
