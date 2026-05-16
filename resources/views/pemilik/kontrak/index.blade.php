@extends('layouts.app')

@section('title', 'Kelola Kontrak - AyoKos')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="{{ route('pemilik.kontrak.index') }}" class="inline-flex items-center text-sm font-medium text-black">
                            <i class="fas fa-file-contract mr-2"></i>
                            Kelola Kontrak
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Header Section -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                    <i class="fas fa-file-contract mr-3"></i>
                    Kelola Kontrak Kos</h1>
                <p class="text-gray-600">Kelola semua permohonan dan kontrak sewa kos Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                 <span class="inline-flex items-center px-3 py-1 text-sm font-bold bg-yellow-400 border-2 border-black text-black">
                     <i class="fas fa-file-contract mr-2"></i>
                     Total: {{ $kontrakPendingCount + $kontrakAktifCount + $kontrakSelesaiCount + $kontrakDitolakCount }} kontrak
                 </span>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 flex items-center">
        <i class="fas fa-check-circle mr-3"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-400 border-2 border-black text-white font-bold px-4 py-3 flex items-center">
        <i class="fas fa-exclamation-circle mr-3"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabs Navigation -->
     
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <div class="border-b-2 border-black">
            <nav class="-mb-px flex overflow-x-auto">
                <button onclick="showTab('pending')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-bold text-sm whitespace-nowrap transition-all duration-300 {{ request('tab', 'pending') === 'pending' ? 'border-yellow-400 text-black bg-yellow-200' : 'border-transparent text-gray-500 hover:text-black hover:bg-gray-100' }}"
                        id="tab-pending">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-clock mr-2 {{ request('tab', 'pending') === 'pending' ? 'text-yellow-600' : 'text-gray-400' }}"></i>
                        Permohonan Pending
                        @if($kontrakPending->count() > 0)
                        <span class="ml-2 bg-black text-white px-2 py-0.5 text-xs font-bold min-w-[24px] text-center">
                            {{ $kontrakPending->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('aktif')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-bold text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'aktif' ? 'border-yellow-400 text-black bg-yellow-200' : 'border-transparent text-gray-500 hover:text-black hover:bg-gray-100' }}"
                        id="tab-aktif">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2 {{ request('tab') === 'aktif' ? 'text-yellow-600' : 'text-gray-400' }}"></i>
                        Kontrak Aktif
                        @if($kontrakAktif->count() > 0)
                        <span class="ml-2 bg-black text-white px-2 py-0.5 text-xs font-bold min-w-[24px] text-center">
                            {{ $kontrakAktif->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('selesai')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-bold text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'selesai' ? 'border-yellow-400 text-black bg-yellow-200' : 'border-transparent text-gray-500 hover:text-black hover:bg-gray-100' }}"
                        id="tab-selesai">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-history mr-2 {{ request('tab') === 'selesai' ? 'text-yellow-600' : 'text-gray-400' }}"></i>
                        Riwayat Selesai
                        @if($kontrakSelesai->count() > 0)
                        <span class="ml-2 bg-black text-white px-2 py-0.5 text-xs font-bold min-w-[24px] text-center">
                            {{ $kontrakSelesai->count() }}
                        </span>
                        @endif
                    </div>
                </button>
                
                <button onclick="showTab('ditolak')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-bold text-sm whitespace-nowrap transition-all duration-300 {{ request('tab') === 'ditolak' ? 'border-yellow-400 text-black bg-yellow-200' : 'border-transparent text-gray-500 hover:text-black hover:bg-gray-100' }}"
                        id="tab-ditolak">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-times-circle mr-2 {{ request('tab') === 'ditolak' ? 'text-yellow-600' : 'text-gray-400' }}"></i>
                        Riwayat Ditolak
                        @if($kontrakDitolak->count() > 0)
                        <span class="ml-2 bg-black text-white px-2 py-0.5 text-xs font-bold min-w-[24px] text-center">
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
                    <div class="bg-gray-100 border-2 border-black p-5 hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-400 border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-user text-black text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Terdaftar: {{ $kontrak->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-bold text-black">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $kontrak->durasi_sewa ?? 0 }} {{ $kontrak->unit_label_lower ?? 'bulan' }}</div>
                            </div>
                            
                            <!-- Price -->
                            <div class="lg:text-right">
                                <div class="text-lg font-black text-black">Rp {{ number_format($kontrak->harga_sewa ?? 0, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-500">per {{ $kontrak->unit_label_lower ?? 'bulan' }}</div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <button type="button"
                                        data-ajax-action="/api/pemilik/kontrak/{{ $kontrak->id_kontrak }}/approve"
                                        data-confirm="Setujui kontrak {{ $kontrak->penghuni->nama ?? '' }}?"
                                        data-success-msg="Kontrak berhasil disetujui"
                                        data-redirect="{{ route('pemilik.kontrak.index', ['tab' => 'aktif']) }}"
                                        class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-check mr-2"></i>
                                    Setujui
                                </button>
                                <button onclick="showRejectModal({{ $kontrak->id_kontrak }}, '{{ $kontrak->penghuni->nama ?? 'Penghuni' }}')"
                                        class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-times mr-2"></i>
                                    Tolak
                                </button>
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
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
                    <div class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check-circle text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Tidak Ada Permohonan Pending</h3>
                    <p class="text-gray-600">Semua permohonan sudah diproses.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Aktif -->
            <div id="content-aktif" class="tab-content {{ request('tab') !== 'aktif' ? 'hidden' : '' }}">
                @if($kontrakAktif->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakAktif as $kontrak)
                    <div class="bg-gray-100 border-2 border-black p-5 hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-400 border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai)
                                            {{ $kontrak->tanggal_mulai->format('d M Y') }} - {{ $kontrak->tanggal_selesai->format('d M Y') }}
                                        @else
                                            <span class="text-yellow-600">Belum ada periode (menunggu pembayaran pertama)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-bold text-black">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Time Remaining -->
                            <div class="lg:text-right">
                                @if($kontrak->tanggal_selesai)
                                    @php
                                        $sisaHari = (int) ceil(now()->diffInDays($kontrak->tanggal_selesai, false));
                                    @endphp
                                    @if($sisaHari > 30)
                                        <span class="inline-flex items-center bg-emerald-400 text-black font-black border-2 border-black px-3 py-1.5 text-sm">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            {{ (int)ceil($sisaHari/30) }} bulan lagi
                                        </span>
                                    @elseif($sisaHari > 0)
                                        <span class="inline-flex items-center bg-yellow-400 text-black font-black border-2 border-black px-3 py-1.5 text-sm">
                                            <i class="fas fa-clock mr-2"></i>
                                            {{ $sisaHari }} hari lagi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center bg-red-400 text-white font-black border-2 border-black px-3 py-1.5 text-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Telah berakhir
                                        </span>
                                    @endif
                                @else
                                    <span class="text-gray-500 text-sm">Belum ditentukan</span>
                                @endif
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                @if($kontrak->tanggal_selesai && now()->greaterThanOrEqualTo($kontrak->tanggal_selesai))
                                <button type="button"
                                        data-ajax-action="/api/pemilik/kontrak/{{ $kontrak->id_kontrak }}/selesai"
                                        data-confirm="Tandai kontrak {{ $kontrak->penghuni->nama ?? '' }} sebagai selesai?"
                                        data-success-msg="Kontrak berhasil diselesaikan"
                                        data-redirect="{{ route('pemilik.kontrak.index') }}"
                                        class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-history mr-2"></i>
                                    Selesai
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-emerald-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Tidak Ada Kontrak Aktif</h3>
                    <p class="text-gray-600">Belum ada penghuni yang aktif di kos Anda.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Selesai -->
            <div id="content-selesai" class="tab-content {{ request('tab') !== 'selesai' ? 'hidden' : '' }}">
                @if($kontrakSelesai->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakSelesai as $kontrak)
                    <div class="bg-gray-100 border-2 border-black p-5 hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gray-300 border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-user text-black text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
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
                                <div class="text-sm font-bold text-black">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Status -->
                            <div class="lg:text-right">
                                <span class="inline-flex items-center bg-gray-300 text-black font-black border-2 border-black px-3 py-1.5 text-sm">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Selesai
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <button type="button"
                                        data-ajax-action="/api/pemilik/kontrak/{{ $kontrak->id_kontrak }}"
                                        data-ajax-method="DELETE"
                                        data-confirm="Hapus riwayat kontrak dari {{ $kontrak->penghuni->nama ?? 'penghuni' }}?"
                                        data-success-msg="Kontrak berhasil dihapus"
                                        data-redirect="{{ route('pemilik.kontrak.index') }}"
                                        class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-history text-gray-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Tidak Ada Riwayat Kontrak Selesai</h3>
                    <p class="text-gray-600">Belum ada kontrak yang selesai.</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Ditolak -->
            <div id="content-ditolak" class="tab-content {{ request('tab') !== 'ditolak' ? 'hidden' : '' }}">
                @if($kontrakDitolak->count() > 0)
                <div class="space-y-4">
                    @foreach($kontrakDitolak as $kontrak)
                    <div class="bg-gray-100 border-2 border-black p-5 hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-red-200 border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-user text-red-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kontrak->penghuni->nama ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $kontrak->penghuni->no_hp ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Ditolak: {{ $kontrak->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-bold text-black">{{ $kontrak->kos->nama_kos ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">Kamar {{ $kontrak->kamar->nomor_kamar ?? '-' }}</div>
                            </div>
                            
                            <!-- Rejection Reason -->
                            <div class="lg:text-right max-w-xs">
                                <div class="text-sm text-gray-600">
                                    @if($kontrak->alasan_ditolak)
                                        <span class="text-red-600 italic font-bold">"{{ $kontrak->alasan_ditolak }}"</span>
                                    @else
                                        <span class="text-gray-400">Tidak ada alasan</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pemilik.kontrak.show', $kontrak->id_kontrak) }}"
                                   class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <button type="button"
                                        data-ajax-action="/api/pemilik/kontrak/{{ $kontrak->id_kontrak }}"
                                        data-ajax-method="DELETE"
                                        data-confirm="Hapus riwayat kontrak yang ditolak dari {{ $kontrak->penghuni->nama ?? 'penghuni' }}?"
                                        data-success-msg="Kontrak berhasil dihapus"
                                        data-redirect="{{ route('pemilik.kontrak.index') }}"
                                        class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] text-sm transition flex items-center">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-times-circle text-red-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Tidak Ada Riwayat Kontrak Ditolak</h3>
                    <p class="text-gray-600">Belum ada kontrak yang ditolak.</p>
                </div>
                @endif
            </div>
            <!-- Table Footer -->
            @if($kontrakDitolak->hasPages())
            <div class="px-6 py-4 border-t-2 border-black">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
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
<div id="rejectModal" class="fixed inset-0 bg-black/60 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border-4 border-black w-96 shadow-[8px_8px_0px_#000] bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                <i class="fas fa-times-circle text-red-600 mr-2"></i>
                Tolak Permohonan Kontrak
            </h3>
            <p class="text-sm text-gray-600 mb-4" id="rejectUserName">
                Alasan penolakan untuk: <span class="text-black font-bold"></span>
            </p>
            
            <form method="POST" action="" id="rejectForm" data-ajax="true" data-success-msg="Kontrak berhasil ditolak" data-redirect="{{ route('pemilik.kontrak.index', ['tab' => 'ditolak']) }}">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label class="block text-sm font-bold text-black mb-2">Alasan Penolakan *</label>
                    <textarea name="alasan_ditolak" 
                              class="w-full px-3 py-2 border-2 border-black text-black font-bold bg-white focus:shadow-[3px_3px_0px_#000] outline-none resize-none"
                              rows="4" 
                              placeholder="Berikan alasan penolakan yang jelas..."
                              required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="px-4 py-2 bg-gray-200 text-black font-bold border-2 border-black hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] transition">
                        <i class="fas fa-times mr-2"></i>
                        Tolak Kontrak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="approveModal" class="fixed inset-0 bg-black/60 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border-4 border-black w-96 shadow-[8px_8px_0px_#000] bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                <i class="fas fa-check-circle text-emerald-600 mr-2"></i>
                Setujui Permohonan Kontrak
            </h3>
            <p class="text-sm text-gray-600 mb-4" id="approveUserName">
                Konfirmasi persetujuan untuk: <span class="text-black font-bold"></span>
            </p>
            
            <form method="POST" action="" id="approveForm" data-ajax="true" data-success-msg="Kontrak berhasil disetujui" data-redirect="{{ route('pemilik.kontrak.index', ['tab' => 'aktif']) }}">
                @csrf
                
                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin menyetujui kontrak ini? Status kamar akan berubah menjadi terisi dan kontrak akan aktif.
                </p>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeApproveModal()"
                            class="px-4 py-2 bg-gray-200 text-black font-bold border-2 border-black hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] transition">
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
                button.classList.remove('border-yellow-400');
                button.classList.remove('text-black');
                button.classList.remove('bg-yellow-200');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Add active style to selected tab
            const activeTab = document.getElementById('tab-' + tabName);
            
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-yellow-400', 'text-black', 'bg-yellow-200');
            
            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            window.history.pushState({}, '', url);
        }

    // Reject modal functionality
    function showRejectModal(kontrakId, userName) {
        document.querySelector('#rejectUserName span').textContent = userName;
        const form = document.getElementById('rejectForm');
        form.dataset.ajaxAction = '/api/pemilik/kontrak/' + kontrakId + '/reject';
        form.action = '/pemilik/kontrak/' + kontrakId + '/reject';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    // Approve modal functionality
    function showApproveModal(actionUrl, userName) {
        document.querySelector('#approveUserName span').textContent = userName;
        const form = document.getElementById('approveForm');
        form.dataset.ajaxAction = actionUrl.replace('/pemilik/', '/api/pemilik/');
        form.action = actionUrl;
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


@endsection