@extends('layouts.app')

@section('title', __('contact.title'))

@section('content')

<div class="bg-[#1B5E20] pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ __('contact.title') }}</h1>
        <p class="text-white/70 text-lg">{{ __('contact.subtitle') }}</p>
    </div>
</div>

<section class="py-20 bg-[#FAFAF7]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">

            <!-- Contact info -->
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <h2 class="font-display text-2xl font-bold text-[#1A1A1A] mb-6">{{ app()->getLocale() === 'fr' ? 'Informations de contact' : 'Contact information' }}</h2>
                    @php
                        $addr = \App\Models\Setting::get('address_' . app()->getLocale(), 'Cotonou, Bénin');
                        $phone = \App\Models\Setting::get('contact_phone');
                        $email = \App\Models\Setting::get('contact_email');
                    @endphp
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-[#1B5E20]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5">{{ __('contact.address') }}</p>
                                <p class="text-[#1A1A1A]">{{ $addr }}</p>
                            </div>
                        </div>
                        @if($phone)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-[#1B5E20]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5">{{ __('contact.phone') }}</p>
                                <a href="tel:{{ $phone }}" class="text-[#1B5E20] hover:underline">{{ $phone }}</a>
                            </div>
                        </div>
                        @endif
                        @if($email)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-[#1B5E20]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5">{{ __('contact.email_label') }}</p>
                                <a href="mailto:{{ $email }}" class="text-[#1B5E20] hover:underline">{{ $email }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- OpenStreetMap -->
                <div class="rounded-2xl overflow-hidden border border-gray-200 h-56">
                    <iframe
                        src="https://www.openstreetmap.org/export/embed.html?bbox=2.3%2C6.3%2C2.5%2C6.4&layer=mapnik"
                        class="w-full h-full border-0"
                        loading="lazy"
                        title="Carte ONG Infentil">
                    </iframe>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-[#1B5E20] rounded-xl p-4 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('contact.name') }} *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border @error('name') border-red-400 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B5E20] text-sm transition-colors">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('contact.email') }} *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B5E20] text-sm transition-colors">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('contact.subject') }} *</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full px-4 py-3 border @error('subject') border-red-400 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B5E20] text-sm transition-colors">
                            @error('subject')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('contact.message') }} *</label>
                            <textarea name="message" rows="6" required
                                      class="w-full px-4 py-3 border @error('message') border-red-400 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B5E20] text-sm transition-colors resize-none">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit"
                                class="w-full bg-[#1B5E20] hover:bg-[#155220] text-white font-bold py-4 rounded-xl text-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            {{ __('contact.send') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
