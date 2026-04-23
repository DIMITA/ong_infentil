@extends('layouts.app')
@section('title', __('newsletter.confirmed'))
@section('content')
<div class="min-h-screen bg-[#FAFAF7] flex items-center justify-center pt-20">
    <div class="max-w-md mx-auto px-4 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="font-display text-3xl font-bold text-[#1A1A1A] mb-3">{{ __('newsletter.confirmed') }}</h1>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-[#1B5E20] text-white font-semibold px-6 py-3 rounded-full hover:bg-[#155220] transition-colors mt-6">
            {{ __('app.home') }}
        </a>
    </div>
</div>
@endsection
