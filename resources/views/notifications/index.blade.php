@extends('layouts.app')

@section('title', 'Notifikasi - AyoKos')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-800 to-slate-900 pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-emerald-300 px-4 py-3 rounded-xl mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-500/20 backdrop-blur-sm border border-rose-500/20 text-rose-300 px-4 py-3 rounded-xl mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
            </div>
        @endif
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-white flex items-center">
                <i class="fas fa-bell mr-3 text-sky-400"></i>
                Notifikasi
            </h1>
            <button onclick="markAllRead()"
                class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm transition">
                <i class="fas fa-check-double mr-2"></i>
                Tandai Semua Dibaca
            </button>
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-3">
                @foreach($notifications as $notif)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:border-sky-500/50 transition-all duration-300 {{ !$notif->is_read ? 'border-l-4 border-l-sky-500' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-white">{{ $notif->title }}</span>
                                    @if(!$notif->is_read)
                                        <span class="w-2 h-2 bg-sky-400 rounded-full"></span>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-300 mb-2">{{ $notif->body }}</p>
                                <div class="flex items-center gap-3 text-xs text-slate-500">
                                    <span>{{ $notif->created_at->diffForHumans() }}</span>
                                    @if($notif->link)
                                        <a href="{{ $notif->link }}" class="text-sky-400 hover:text-sky-300">
                                            <i class="fas fa-external-link-alt mr-1"></i>Lihat Detail
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @if(!$notif->is_read)
                                <button onclick="markRead('{{ $notif->id_notifikasi }}')"
                                    class="ml-4 text-slate-400 hover:text-white transition">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bell-slash text-white text-3xl"></i>
                </div>
                <h3 class="text-white font-semibold mb-2">Belum ada notifikasi</h3>
                <p class="text-slate-400 text-sm">Notifikasi akan muncul di sini setelah ada aktivitas</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    async function markRead(id) {
        try {
            await axios.post('/api/notifications/' + id + '/read');
            location.reload();
        } catch (e) {
            console.error(e);
        }
    }

    async function markAllRead() {
        try {
            await axios.post('/api/notifications/mark-all-read');
            location.reload();
        } catch (e) {
            console.error(e);
        }
    }
</script>
@endpush
@endsection
