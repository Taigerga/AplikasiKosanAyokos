<div class="text-center py-12 {{ $class ?? '' }}">
    <div class="text-5xl mb-4">⚠️</div>
    <h3 class="text-lg font-bold mb-2">{{ $title ?? 'Terjadi Kesalahan' }}</h3>
    <p class="text-gray-600 mb-6">{{ $message ?? 'Gagal memuat data. Silakan coba lagi.' }}</p>
    @if ($showRetry ?? true)
    <button onclick="window.location.reload()" class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white font-bold border-2 border-black shadow-hard hover:shadow-hard-lg transition-shadow rounded-lg">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        Muat Ulang
    </button>
    @endif
</div>
