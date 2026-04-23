@extends('layouts.app')

@section('title', __('donate.title'))

@section('content')

<!-- Hero -->
<div class="bg-gradient-to-br from-[#1B5E20] to-[#2d7a35] pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-[#C17D3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <h1 class="font-display text-5xl font-bold text-white mb-4">{{ __('donate.title') }}</h1>
        <p class="text-white/70 text-xl">{{ __('donate.subtitle') }}</p>
    </div>
</div>

<!-- Impact teaser -->
<div class="bg-[#C17D3C] py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-8 text-white text-sm text-center">
            <div><span class="font-bold text-lg">5 000 FCFA</span><br><span class="opacity-80">= 1 consultation médicale</span></div>
            <div class="w-px h-8 bg-white/30 hidden sm:block"></div>
            <div><span class="font-bold text-lg">15 000 FCFA</span><br><span class="opacity-80">= 1 kit scolaire complet</span></div>
            <div class="w-px h-8 bg-white/30 hidden sm:block"></div>
            <div><span class="font-bold text-lg">50 000 FCFA</span><br><span class="opacity-80">= 1 mois de suivi nutritionnel</span></div>
        </div>
    </div>
</div>

<!-- Donation options -->
<section class="py-20 bg-[#FAFAF7]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- KKiaPay block -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-[#1B5E20]/10 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-display text-xl font-bold text-[#1A1A1A]">{{ __('donate.africa_title') }}</h2>
                        <span class="inline-block bg-green-100 text-[#1B5E20] text-xs font-medium px-2 py-0.5 rounded-full">Afrique de l'Ouest</span>
                    </div>
                </div>
                <p class="text-gray-500 text-sm mb-6">{{ __('donate.africa_subtitle') }}</p>

                <!-- Amount picker -->
                <div class="mb-5" x-data="{ amount: 10000, custom: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-3">{{ app()->getLocale() === 'fr' ? 'Choisissez un montant (FCFA)' : 'Choose an amount (FCFA)' }}</label>
                    <div class="grid grid-cols-3 gap-2 mb-3">
                        @foreach([5000, 10000, 25000, 50000, 100000, 0] as $preset)
                        <button type="button"
                                @click="amount = {{ $preset ?: 'null' }}; custom = {{ $preset === 0 ? 'true' : 'false' }}"
                                :class="amount === {{ $preset ?: 'null' }} && !custom ? 'bg-[#1B5E20] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                class="py-2.5 rounded-xl text-sm font-semibold transition-colors">
                            @if($preset === 0)
                                {{ app()->getLocale() === 'fr' ? 'Autre' : 'Other' }}
                            @else
                                {{ number_format($preset) }}
                            @endif
                        </button>
                        @endforeach
                    </div>
                    <div x-show="custom" class="mb-3">
                        <input type="number" x-model="amount" placeholder="{{ __('donate.amount_placeholder') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B5E20] text-sm">
                    </div>

                    @if($kkiapayKey)
                    <button type="button"
                            @click="openKKiaPay(amount)"
                            :disabled="!amount || amount < 100"
                            class="w-full bg-[#1B5E20] disabled:opacity-50 hover:bg-[#155220] text-white font-bold py-4 rounded-xl text-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        {{ __('donate.donate_button') }}
                        <span x-show="amount" x-text="'— ' + (amount ? parseInt(amount).toLocaleString() : '') + ' FCFA'"></span>
                    </button>
                    @else
                    <div class="bg-amber-50 border border-amber-200 text-amber-700 text-sm p-3 rounded-xl">
                        KKiaPay n'est pas encore configuré. Contactez l'administrateur.
                    </div>
                    @endif
                </div>

                <p class="text-xs text-gray-400 text-center flex items-center justify-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    {{ __('donate.secure') }}
                </p>
            </div>

            <!-- Donorbox block -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-[#C17D3C]/10 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#C17D3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-display text-xl font-bold text-[#1A1A1A]">{{ __('donate.international_title') }}</h2>
                        <span class="inline-block bg-orange-100 text-[#C17D3C] text-xs font-medium px-2 py-0.5 rounded-full">International</span>
                    </div>
                </div>
                <p class="text-gray-500 text-sm mb-6">{{ __('donate.international_subtitle') }}</p>

                @if($donorboxUrl)
                <div class="rounded-xl overflow-hidden">
                    <script src="https://donorbox.org/widget.js" paypalExpress="false"></script>
                    <iframe src="{{ $donorboxUrl }}"
                            name="donorbox"
                            allowpaymentrequest="allowpaymentrequest"
                            seamless="seamless"
                            frameborder="0"
                            scrolling="no"
                            height="900px"
                            width="100%"
                            style="max-width: 500px; min-width: 250px; max-height: none !important"
                            allow="payment">
                    </iframe>
                </div>
                @else
                <div class="bg-blue-50 border border-blue-200 text-blue-700 text-sm p-4 rounded-xl text-center">
                    <p class="font-medium mb-1">{{ app()->getLocale() === 'fr' ? 'Don international bientôt disponible' : 'International donation coming soon' }}</p>
                    <p>{{ app()->getLocale() === 'fr' ? 'Contactez-nous directement pour faire un don.' : 'Contact us directly to donate.' }}</p>
                    <a href="{{ route('contact') }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        {{ __('app.contact') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@if($kkiapayKey)
@push('head')
<script src="https://cdn.kkiapay.me/k.js"></script>
@endpush

@push('scripts')
<script>
function openKKiaPay(amount) {
    if (!amount || amount < 100) return;
    openKkiapayWidget({
        amount: parseInt(amount),
        api_key: "{{ $kkiapayKey }}",
        sandbox: {{ $sandbox ? 'true' : 'false' }},
        name: "",
        phone: "",
        email: "",
        theme: "#1B5E20",
        callback: function(response) {
            if (response.transactionId) {
                window.location.href = "{{ route('donate.merci') }}?ref=" + response.transactionId;
            }
        }
    });
}
successKkiapayPayment(function(response) {
    window.location.href = "{{ route('donate.merci') }}?ref=" + response.transactionId;
});
</script>
@endpush
@endif
