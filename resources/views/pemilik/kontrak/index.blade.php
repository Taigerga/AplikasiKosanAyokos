@extends('layouts.app')

@section('title', 'Kelola Kontrak - AyoKos')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                        <a href="{{ route('pemilik.kontrak.index') }}" class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-file-contract mr-2"></i>
                            Kelola Kontrak
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Header Section -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                    <i class="fas fa-file-contract mr-3"></i>
                    Kelola Kontrak Kos</h1>
                <p class="text-slate-100">Kelola semua permohonan dan kontrak sewa kos Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                 <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/5 backdrop-blur-sm border border-white/20 text-white">
                     <i class="fas fa-file-contract mr-2"></i>
                     Total: {{ $kontrakPendingCount + $kontrakAktifCount + $kontrakSelesaiCount + $kontrakDitolakCount }} kontrak
                 </span>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 text-slate-100 px-4 py-3 rounded-xl flex items-center">
        <i class="fas fa-check-circle mr-3 text-sky-400"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 text-slate-100 px-4 py-3 rounded-xl flex items-center">
        <i class="fas fa-times-circle mr-3 text-red-300"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabs Navigation -->
     
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
        <div class="border-b border-white/20">
            <nav class="-mb-px flex overflow-x-auto">
                <button onclick="showTab('pending')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 {{ request('tab', 'pending') === 'pending' ? 'border-sky-500 text-sky-300 bg-sky-500/10' : 'border-transparent text-slate-100 hover:text-white hover:bg-white/10' }}"
                        id="tab-pending">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-clock mr-2 {{ request('tab', 'pending') === 'pending' ? 'text-sky-400' : 'text-slate-100' }}"></i>
                        Permohonan Pending
                        @if($kontrakPending->count() > 0)
                        <span class="ml-2 bg-white/5 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            {{ $kontrakPending->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('aktif')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'aktif' ? 'border-emerald-500 text-emerald-300 bg-emerald-500/10' : 'border-transparent text-slate-100 hover:text-white hover:bg-white/10' }}"
                        id="tab-aktif">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2 {{ request('tab') === 'aktif' ? 'text-emerald-400' : 'text-slate-100' }}"></i>
                        Kontrak Aktif
                        @if($kontrakAktif->count() > 0)
                        <span class="ml-2 bg-white/5 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            {{ $kontrakAktif->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('selesai')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'selesai' ? 'border-slate-400 text-slate-300 bg-slate-500/10' : 'border-transparent text-slate-100 hover:text-white hover:bg-white/10' }}"
                        id="tab-selesai">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-history mr-2 {{ request('tab') === 'selesai' ? 'text-slate-400' : 'text-slate-100' }}"></i>
                        Riwayat Selesai
                        @if($kontrakSelesai->count() > 0)
                        <span class="ml-2 bg-white/5 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            {{ $kontrakSelesai->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('ditolak')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'ditolak' ? 'border-red-500 text-red-300 bg-red-500/10' : 'border-transparent text-slate-100 hover:text-white hover:bg-white/10' }}"
                        id="tab-ditolak">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-times-circle mr-2 {{ request('tab') === 'ditolak' ? 'text-red-400' : 'text-slate-100' }}"></i>
                        Riwayat Ditolak
                        @if($kontrakDitolak->count() > 0)
                        <span class="ml-2 bg-white/5 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            {{ $kontrakDitolak->count() }}
                        </span>
                        @endif
                    </div>
                </button>
            </nav>
        </div>

        <!-- Tab Content Container -->
        <div class="p-6">
            <!-- Tab Content: Pending -->
            <div id="content-pending" class="tab-content {{ request('tab', 'pending') !== 'pending' ? 'hidden' : '' }}">
                @if($kontrakPending->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakPending as $kontrak)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:border-yellow-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-500/20 backdrop-blur-sm border border-yellow-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-yellow-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-slate-100">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-slate-100/70 mt-1">Terdaftar: {{ $kontrak->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-100">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                                <div class="text-xs text-slate-100 mt-1">{{ $kontrak->durasi_sewa ?? 0 }} {{ $kontrak->unit_label_lower ?? 'bulan' }}</div>
                            </div>
                            
                            <!-- Price -->
                            <div class="lg:text-right">
                                <div class="text-lg font-bold text-white">Rp {{ number_format($kontrak->harga_sewa ?? 0, 0, ',', '.') }}</div>
                                <div class="text-xs text-slate-100">per {{ $kontrak->unit_label_lower ?? 'bulan' }}</div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <button onclick="showApproveModal('{{ route('pemilik.kontrak.approve', $kontrak->id_kontrak) }}', '{{ $kontrak->penghuni->nama ?? 'Penghuni' }}')"
                                        class="px-4 py-2 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 hover:bg-emerald-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-check mr-2"></i>
                                    Setujui
                                </button>
                                <button onclick="showRejectModal({{ $kontrak->id_kontrak }}, '{{ $kontrak->penghuni->nama ?? 'Penghuni' }}')"
                                        class="px-4 py-2 bg-red-500/20 backdrop-blur-sm border border-red-500/20 hover:bg-red-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-times mr-2"></i>
                                    Tolak
                                </button>
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check-circle text-sky-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Permohonan Pending</h3>
                    <p class="text-slate-100">Semua permohonan sudah diproses.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Aktif -->
            <div id="content-aktif" class="tab-content {{ request('tab') !== 'aktif' ? 'hidden' : '' }}">
                @if($kontrakAktif->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakAktif as $kontrak)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:border-emerald-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-emerald-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-slate-100">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-slate-100/70 mt-1">
                                        @if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai)
                                            {{ $kontrak->tanggal_mulai->format('d M Y') }} - {{ $kontrak->tanggal_selesai->format('d M Y') }}
                                        @else
                                            <span class="text-yellow-400">Belum ada periode (menunggu pembayaran pertama)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-100">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Time Remaining -->
                            <div class="lg:text-right">
                                @if($kontrak->tanggal_selesai)
                                    @php
                                        $sisaHari = (int) ceil(now()->diffInDays($kontrak->tanggal_selesai, false));
                                    @endphp
                                    @if($sisaHari > 30)
                                        <span class="inline-flex items-center bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-emerald-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            {{ (int)ceil($sisaHari/30) }} bulan lagi
                                        </span>
                                    @elseif($sisaHari > 0)
                                        <span class="inline-flex items-center bg-yellow-500/20 backdrop-blur-sm border border-yellow-500/20 text-yellow-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-clock mr-2"></i>
                                            {{ $sisaHari }} hari lagi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-red-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Telah berakhir
                                        </span>
                                    @endif
                                @else
                                    <span class="text-slate-100 text-sm">Belum ditentukan</span>
                                @endif
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                @if($kontrak->tanggal_selesai && now()->greaterThanOrEqualTo($kontrak->tanggal_selesai))
                                <form method="POST" action="{{ route('pemilik.kontrak.selesai', $kontrak->id_kontrak) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-slate-500/20 backdrop-blur-sm border border-slate-500/20 hover:bg-slate-500/10 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Tandai kontrak {{ $kontrak->penghuni->nama ?? '' }} sebagai selesai?')">
                                        <i class="fas fa-history mr-2"></i>
                                        Selesai
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-emerald-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Kontrak Aktif</h3>
                    <p class="text-slate-100">Belum ada penghuni yang aktif di kos Anda.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Selesai -->
            <div id="content-selesai" class="tab-content {{ request('tab') !== 'selesai' ? 'hidden' : '' }}">
                @if($kontrakSelesai->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakSelesai as $kontrak)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:border-slate-400/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-slate-500/20 backdrop-blur-sm border border-slate-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-slate-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-slate-100">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-slate-100/70 mt-1">
                                        @if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai)
                                            {{ $kontrak->tanggal_mulai->format('d M Y') }} - {{ $kontrak->tanggal_selesai->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-100">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Status -->
                            <div class="lg:text-right">
                                <span class="inline-flex items-center bg-slate-500/20 backdrop-blur-sm border border-slate-500/20 text-slate-300 px-3 py-1.5 rounded-lg text-sm">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Selesai
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('pemilik.kontrak.destroy', $kontrak->id_kontrak) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-500/20 backdrop-blur-sm border border-red-500/20 hover:bg-red-500/10 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Hapus riwayat kontrak dari {{ $kontrak->penghuni->nama ?? 'penghuni' }}?\\n\\nData yang dihapus tidak dapat dikembalikan!')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-history text-slate-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Riwayat Kontrak Selesai</h3>
                    <p class="text-slate-100">Belum ada kontrak yang selesai.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Ditolak -->
            <div id="content-ditolak" class="tab-content {{ request('tab') !== 'ditolak' ? 'hidden' : '' }}">
                @if($kontrakDitolak->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakDitolak as $kontrak)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:border-red-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-red-500/20 backdrop-blur-sm border border-red-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-red-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-slate-100">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-slate-100/70 mt-1">
                                        Ditolak: {{ $kontrak->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-100">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Rejection Reason -->
                            <div class="lg:text-right max-w-xs">
                                <div class="text-sm text-slate-100">
                                    @if($kontrak->alasan_ditolak)
                                        <span class="text-red-300 italic">"{{ $kontrak->alasan_ditolak }}"</span>
                                    @else
                                        <span class="text-slate-100/50">Tidak ada alasan</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('pemilik.kontrak.destroy', $kontrak->id_kontrak) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-500/20 backdrop-blur-sm border border-red-500/20 hover:bg-red-500/10 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Hapus riwayat kontrak yang ditolak dari {{ $kontrak->penghuni->nama ?? 'penghuni' }}?\\n\\nData yang dihapus tidak dapat dikembalikan!')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-times-circle text-red-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Riwayat Kontrak Ditolak</h3>
                    <p class="text-slate-100">Belum ada kontrak yang ditolak.</p>
                </div>
                @endif
            </div>
            <!-- Table Footer -->
            @if($kontrakDitolak->hasPages())
            <div class="px-6 py-4 border-t border-white/20">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-100">
                        Menampilkan {{ $kontrakDitolak->firstItem() }} - {{ $kontrakDitolak->lastItem() }} dari {{ $kontrakDitolak->total() }} kontrak
                    </div>
                    <div class="flex space-x-2">
                        {{ $kontrakDitolak->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
            @endif

            
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                Tolak Permohonan Kontrak
            </h3>
            <p class="text-sm text-slate-500 mb-4" id="rejectUserName">
                Alasan penolakan untuk: <span class="text-slate-800 font-medium"></span>
            </p>
            
            <form method="POST" action="" id="rejectForm">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-800 mb-2">Alasan Penolakan *</label>
                    <textarea name="alasan_ditolak" 
                              class="w-full px-3 py-2 bg-slate-100 border border-slate-200 text-slate-700 rounded-lg focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/30"
                              rows="4" 
                              placeholder="Berikan alasan penolakan yang jelas..."
                              required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition shadow-lg">
                        <i class="fas fa-times mr-2"></i>
                        Tolak Kontrak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="approveModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                <i class="fas fa-check-circle text-emerald-600 mr-2"></i>
                Setujui Permohonan Kontrak
            </h3>
            <p class="text-sm text-slate-500 mb-4" id="approveUserName">
                Konfirmasi persetujuan untuk: <span class="text-slate-800 font-medium"></span>
            </p>
            
            <form method="POST" action="" id="approveForm">
                @csrf
                @method('POST')
                
                <p class="text-sm text-slate-500 mb-6">
                    Apakah Anda yakin ingin menyetujui kontrak ini? Status kamar akan berubah menjadi terisi dan kontrak akan aktif.
                </p>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeApproveModal()"
                            class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition shadow-lg">
                        <i class="fas fa-check mr-2"></i>
                        Setujui Kontrak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tab functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active styles from all tabs
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-sky-500', 'border-emerald-500', 'border-slate-400', 'border-red-500');
            button.classList.remove('text-sky-300', 'text-emerald-300', 'text-slate-300', 'text-red-300');
            button.classList.remove('bg-sky-500/10', 'bg-emerald-500/10', 'bg-slate-500/10', 'bg-red-500/10');
            button.classList.add('border-transparent', 'text-slate-100');
        });
        
        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Add active style to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        const colors = {
            'pending': { border: 'border-sky-500', text: 'text-sky-300', bg: 'bg-sky-500/10' },
            'aktif': { border: 'border-emerald-500', text: 'text-emerald-300', bg: 'bg-emerald-500/10' },
            'selesai': { border: 'border-slate-400', text: 'text-slate-300', bg: 'bg-slate-500/10' },
            'ditolak': { border: 'border-red-500', text: 'text-red-300', bg: 'bg-red-500/10' }
        };
        
        activeTab.classList.remove('border-transparent', 'text-slate-100');
        activeTab.classList.add(colors[tabName].border, colors[tabName].text, colors[tabName].bg);
        
        // Update URL without page reload
        const url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        window.history.pushState({}, '', url);
    }

    // Reject modal functionality
    function showRejectModal(kontrakId, userName) {
        document.querySelector('#rejectUserName span').textContent = userName;
        document.getElementById('rejectForm').action = '/pemilik/kontrak/' + kontrakId + '/reject';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    // Approve modal functionality
    function showApproveModal(actionUrl, userName) {
        document.querySelector('#approveUserName span').textContent = userName;
        document.getElementById('approveForm').action = actionUrl;
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const rejectModal = document.getElementById('rejectModal');
        const approveModal = document.getElementById('approveModal');
        
        if (event.target === rejectModal) {
            closeRejectModal();
        }
        if (event.target === approveModal) {
            closeApproveModal();
        }
    }

    // Initialize based on URL parameter
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'pending';
        showTab(tab);
    });
</script>

<style>
    .tab-button {
        min-width: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .tab-button:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #f1f5f9 !important;
    }
    
    .tab-button.active {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.3);
    }
</style>
@endsection