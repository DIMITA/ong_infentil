@extends('layouts.app')
@section('title', __('newsletter.unsubscribed'))
@section('content')
<div class="min-h-screen bg-[#FAFAF7] flex items-center justify-center pt-20">
    <div class="max-w-md mx-auto px-4 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
            </svg>
        </div>
        <h1 class="font-display text-3xl font-bold text-[#1A1A1A] mb-3">{{ __('newsletter.unsubscribed') }}</h1>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 border border-gray-300 text-gray-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-50 transition-colors mt-6">
            {{ __('app.home') }}
        </a>
    </div>
</div>
@endsection
