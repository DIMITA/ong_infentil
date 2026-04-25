<footer class="bg-[#1A1A1A] text-white">
    <!-- Newsletter band -->
    <div class="bg-[#1B5E20] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="font-display text-2xl font-bold text-white">{{ __('newsletter.title') }}</h3>
                    <p class="text-white/70 mt-1">{{ __('newsletter.subtitle') }}</p>
                </div>
                @include('components.newsletter-form')
            </div>
        </div>
    </div>

    <!-- Main footer -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-[#1B5E20] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="font-display text-2xl font-bold">Graines de vie</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                        {{ app()->getLocale() === 'fr'
                            ? 'ONG béninoise engagée depuis 2015 pour la santé, la nutrition et l\'éducation des enfants dans les zones rurales du Bénin.'
                            : 'Beninese NGO committed since 2015 to health, nutrition and education for children in rural Benin.' }}
                    </p>
                    <!-- Social links -->
                    <div class="flex items-center gap-4 mt-6">
                        @php $fbUrl = \App\Models\Setting::get('facebook_url'); @endphp
                        @if($fbUrl)
                        <a href="{{ $fbUrl }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-white/10 hover:bg-[#1B5E20] rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Navigation -->
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Navigation</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.home') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.about') }}</a></li>
                        <li><a href="{{ route('actions.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.actions') }}</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.events') }}</a></li>
                        <li><a href="{{ route('documents.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.documents') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white text-sm transition-colors">{{ __('app.contact') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">{{ __('contact.title') }}</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        @php
                            $addr = \App\Models\Setting::get('address_' . app()->getLocale(), 'Cotonou, Bénin');
                            $phone = \App\Models\Setting::get('contact_phone');
                            $email = \App\Models\Setting::get('contact_email');
                        @endphp
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-[#C17D3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $addr }}
                        </li>
                        @if($phone)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#C17D3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ $phone }}" class="hover:text-white transition-colors">{{ $phone }}</a>
                        </li>
                        @endif
                        @if($email)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#C17D3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $email }}" class="hover:text-white transition-colors">{{ $email }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-white/10 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-gray-500 text-xs">
                © {{ date('Y') }} Graines de vie. {{ app()->getLocale() === 'fr' ? 'Tous droits réservés.' : 'All rights reserved.' }}
            </p>
            <div class="flex items-center gap-4">
                <a href="{{ route('lang.switch', app()->getLocale() === 'fr' ? 'en' : 'fr') }}"
                   class="text-gray-500 hover:text-white text-xs transition-colors">
                    🌐 {{ __('app.lang_switch') }}
                </a>
                <a href="{{ route('donate') }}" class="text-[#C17D3C] hover:text-white text-xs font-semibold transition-colors">
                    {{ __('app.donate') }} →
                </a>
            </div>
        </div>
    </div>
</footer>
