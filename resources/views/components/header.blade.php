<header
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40)"
    :class="scrolled ? 'bg-white shadow-md py-2' : 'bg-transparent py-4'"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-[#1B5E20] rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div>
                    <span :class="scrolled ? 'text-[#1B5E20]' : 'text-white'" class="font-display text-xl font-bold leading-tight transition-colors">
                        Graines de vie
                    </span>
                    <p :class="scrolled ? 'text-gray-500' : 'text-white/70'" class="text-xs hidden sm:block transition-colors">Bénin · Santé Infantile</p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1">
                @php
                    $navLinks = [
                        route('home') => __('app.home'),
                        route('about') => __('app.about'),
                        route('actions.index') => __('app.actions'),
                        route('events.index') => __('app.events'),
                        route('blog.index') => __('app.blog'),
                        route('documents.index') => __('app.documents'),
                        route('contact') => __('app.contact'),
                    ];
                @endphp
                @foreach($navLinks as $url => $label)
                    <a href="{{ $url }}"
                       :class="scrolled ? 'text-gray-700 hover:text-[#1B5E20]' : 'text-white/90 hover:text-white'"
                       class="px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-white/10">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <!-- Right actions -->
            <div class="flex items-center gap-3">
                <!-- Lang switch -->
                <a href="{{ route('lang.switch', app()->getLocale() === 'fr' ? 'en' : 'fr') }}"
                   :class="scrolled ? 'text-gray-600 hover:text-[#1B5E20] border-gray-300' : 'text-white/80 hover:text-white border-white/30'"
                   class="hidden sm:flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 border rounded-full transition-all hover:scale-105">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                    {{ __('app.lang_code') }}
                </a>

                <!-- Donate CTA -->
                <a href="{{ route('donate') }}"
                   class="hidden sm:inline-flex items-center gap-2 bg-[#C17D3C] hover:bg-[#a06830] text-white text-sm font-semibold px-4 py-2 rounded-full transition-all hover:scale-105 shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    {{ __('app.donate') }}
                </a>

                <!-- Mobile menu button -->
                <button @click="mobileOpen = !mobileOpen"
                        :class="scrolled ? 'text-gray-700' : 'text-white'"
                        class="lg:hidden p-2 rounded-lg transition-colors">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="lg:hidden bg-white border-t border-gray-100 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            @foreach($navLinks as $url => $label)
                <a href="{{ $url }}" @click="mobileOpen = false"
                   class="block px-4 py-3 text-gray-700 hover:text-[#1B5E20] hover:bg-green-50 rounded-lg font-medium transition-colors">
                    {{ $label }}
                </a>
            @endforeach
            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('lang.switch', app()->getLocale() === 'fr' ? 'en' : 'fr') }}"
                   class="text-sm text-gray-500 hover:text-[#1B5E20] font-medium">
                    🌐 {{ __('app.lang_switch') }}
                </a>
                <a href="{{ route('donate') }}" class="bg-[#C17D3C] text-white text-sm font-semibold px-4 py-2 rounded-full">
                    {{ __('app.donate') }}
                </a>
            </div>
        </div>
    </div>
</header>
