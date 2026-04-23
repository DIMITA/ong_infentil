@extends('layouts.app')
@section('title', __('donate.merci_title'))
@section('content')
<div class="min-h-screen bg-[#FAFAF7] flex items-center justify-center pt-20 pb-16">
    <div class="max-w-lg mx-auto px-4 text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="font-display text-4xl font-bold text-[#1A1A1A] mb-4">{{ __('donate.merci_title') }}</h1>
        <p class="text-gray-600 text-lg mb-8">{{ __('donate.merci_text') }}</p>
        @if(request('ref'))
        <p class="text-sm text-gray-400 mb-8">{{ app()->getLocale() === 'fr' ? 'Référence transaction' : 'Transaction reference' }}: <span class="font-mono text-gray-600">{{ request('ref') }}</span></p>
        @endif
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-[#1B5E20] text-white font-semibold px-6 py-3 rounded-full hover:bg-[#155220] transition-colors">
                {{ __('app.home') }}
            </a>
            <a href="{{ route('donate') }}" class="inline-flex items-center gap-2 border border-[#1B5E20] text-[#1B5E20] font-semibold px-6 py-3 rounded-full hover:bg-green-50 transition-colors">
                {{ app()->getLocale() === 'fr' ? 'Faire un autre don' : 'Donate again' }}
            </a>
        </div>
    </div>
</div>
@endsection
