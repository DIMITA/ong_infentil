<div x-data="{ submitted: {{ session('newsletter_success') ? 'true' : 'false' }} }">
    <div x-show="submitted" class="text-white font-medium py-2">
        ✓ {{ session('newsletter_success') ?? __('newsletter.check_email') }}
    </div>
    <form x-show="!submitted" action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-2 max-w-md w-full">
        @csrf
        <input type="text" name="name" placeholder="{{ __('newsletter.placeholder_name') }}"
               class="flex-1 px-4 py-2.5 rounded-full text-sm bg-white/10 text-white placeholder-white/50 border border-white/20 focus:outline-none focus:border-white/60 transition-colors">
        <input type="email" name="email" required placeholder="{{ __('newsletter.placeholder_email') }}"
               class="flex-1 px-4 py-2.5 rounded-full text-sm bg-white/10 text-white placeholder-white/50 border border-white/20 focus:outline-none focus:border-white/60 transition-colors">
        <button type="submit"
                class="px-5 py-2.5 bg-[#C17D3C] hover:bg-[#a06830] text-white text-sm font-semibold rounded-full transition-all hover:scale-105 whitespace-nowrap">
            {{ __('newsletter.subscribe') }}
        </button>
    </form>
</div>
