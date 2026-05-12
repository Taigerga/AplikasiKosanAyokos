@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="p-4 md:p-6 max-w-3xl mx-auto">
    <div class="space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('penghuni.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-white/60 hover:text-white transition-colors">
                            <i class="fas fa-gauge mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-white/40 text-xs mx-2"></i>
                            <a href="{{ route('penghuni.pembayaran.index') }}"
                                class="inline-flex items-center text-sm font-medium text-white/60 hover:text-white transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>
                                Riwayat Pembayaran
                            </a>
                        </div>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-white/40 text-xs mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-white">
                                <i class="fas fa-eye mr-2"></i>
                                Detail Pembayaran
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-receipt text-white text-xl"></i>
                    </div>
                    <span>Detail Pembayaran</span>
                </h1>
                <p class="text-white/60">Informasi lengkap transaksi pembayaran kos</p>
            </div>
            <a href="{{ route('penghuni.pembayaran.index') }}"
               class="inline-flex items-center px-4 py-2 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-xl hover:bg-emerald-500/30 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
            <!-- Status Banner -->
            <div class="p-6 border-b border-white/20
                {{ $pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-500/10' :
                   ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-500/10' :
                   ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-500/10' :
                   'bg-gray-500/10')) }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <span class="text-xs font-medium text-white/70">Status Pembayaran</span>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="px-4 py-2 rounded-full text-sm font-medium
                                {{ $pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-50 text-emerald-600' :
                                   ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                   ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-50 text-red-600' :
                                   'bg-gray-100 text-gray-600')) }}">
                                {{ ucfirst($pembayaran->status_pembayaran) }}
                            </span>
                            <span class="text-white font-bold text-xl">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <span class="text-xs text-white/70 block">No. Transaksi</span>
                        <span class="text-sm text-white font-mono">#PAY-{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Kos Information -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-home text-white mr-3"></i>
                                Informasi Kos
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-white/60">Nama Kos</span>
                                    <span class="font-medium text-white">{{ $pembayaran->kontrak->kos->nama_kos ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-white/60">Alamat</span>
                                    <span class="font-medium text-white text-right">{{ $pembayaran->kontrak->kos->alamat ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-white/60">Kamar</span>
                                    <span class="font-medium text-white">No. {{ $pembayaran->kontrak->kamar->nomor_kamar ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-credit-card text-white mr-3"></i>
                                Metode Pembayaran
                            </h3>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                        <i class="fas
                                            {{ $pembayaran->metode_pembayaran == 'transfer' ? 'fa-university' :
                                               ($pembayaran->metode_pembayaran == 'cash' ? 'fa-money-bill-wave' : 'fa-qrcode') }}
                                            text-white"></i>
                                    </div>
                                    <div>
                                        <span class="block font-medium text-white capitalize">{{ $pembayaran->metode_pembayaran }}</span>
                                        <span class="text-xs text-white/60">Metode yang digunakan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Payment Timeline -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-white mr-3"></i>
                                Timeline Pembayaran
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-white/5 backdrop-blur-sm flex items-center justify-center">
                                            <i class="fas fa-calendar text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-white/60">Jatuh Tempo</span>
                                            <span class="text-white font-medium">{{ \Carbon\Carbon::parse($pembayaran->tanggal_jatuh_tempo)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white/60">Tanggal</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full
                                            {{ $pembayaran->tanggal_bayar ? 'bg-emerald-500/20' : 'bg-white/5 backdrop-blur-sm' }} flex items-center justify-center">
                                            <i class="fas
                                                {{ $pembayaran->tanggal_bayar ? 'fa-check text-emerald-400' : 'fa-clock text-white' }}
                                                text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-white/60">Tanggal Bayar</span>
                                            <span class="text-white font-medium">
                                                {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d M Y H:i') : 'Menunggu pembayaran' }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $pembayaran->tanggal_bayar ? 'bg-emerald-50 text-emerald-600' : 'bg-yellow-50 text-yellow-600' }}">
                                        {{ $pembayaran->tanggal_bayar ? 'Telah Dibayar' : 'Pending' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-white/5 backdrop-blur-sm flex items-center justify-center">
                                            <i class="fas fa-calendar-check text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-white/60">Periode</span>
                                            <span class="text-white font-medium">{{ \Carbon\Carbon::createFromFormat('Y-m', $pembayaran->bulan_tahun)->format('F Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white/60">Bulan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-info-circle text-white mr-3"></i>
                                Informasi Tambahan
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-white/60">Keterangan</span>
                                    <span class="font-medium text-white text-right">{{ $pembayaran->keterangan ?? 'Tidak ada keterangan' }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-white/60">Dibuat pada</span>
                                    <span class="font-medium text-white">{{ $pembayaran->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-white/60">Terakhir diupdate</span>
                                    <span class="font-medium text-white">{{ $pembayaran->updated_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran Section -->
                @if($pembayaran->bukti_pembayaran)
                <div class="mt-8 border-t border-white/20 pt-8">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-file-image text-white mr-3"></i>
                        Bukti Pembayaran
                    </h3>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                            <div>
                                <span class="block text-sm text-white/60 mb-1">File Bukti Pembayaran</span>
                                <span class="text-white font-medium">bukti_pembayaran_{{ $pembayaran->id_pembayaran }}.jpg</span>
                            </div>
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-lg hover:bg-emerald-500/30 transition">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka di Tab Baru
                            </a>
                        </div>

                        <div class="border border-white/20 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                 alt="Bukti Pembayaran"
                                 class="w-full h-auto max-h-96 object-contain bg-white/5">
                        </div>

                        <div class="mt-4 text-xs text-white/60 text-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Klik gambar untuk memperbesar
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-8 border-t border-white/20 pt-8">
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-image text-white text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-white mb-2">Tidak Ada Bukti Pembayaran</h4>
                        <p class="text-white/60">Bukti pembayaran belum diunggah</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-white/20 p-6">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <div class="flex items-center space-x-2 text-white/60">
                        <i class="fas fa-question-circle"></i>
                        <span class="text-sm">Butuh bantuan? Hubungi admin</span>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('penghuni.pembayaran.index') }}"
                           class="px-5 py-2.5 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition">
                            <i class="fas fa-list mr-2"></i>
                            Riwayat Pembayaran
                        </a>
                        @if($pembayaran->status_pembayaran == 'pending')
                        <a href="#"
                           class="px-5 py-2.5 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-xl hover:bg-emerald-500/30 transition">
                            <i class="fas fa-credit-card mr-2"></i>
                            Bayar Sekarang
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas
                            {{ $pembayaran->status_pembayaran == 'lunas' ? 'fa-check-circle text-emerald-400' :
                               ($pembayaran->status_pembayaran == 'pending' ? 'fa-clock text-yellow-400' :
                               ($pembayaran->status_pembayaran == 'terlambat' ? 'fa-exclamation-circle text-red-400' :
                               'fa-question-circle text-gray-400')) }}"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-white/60">Status</span>
                        <span class="font-semibold text-white">{{ ucfirst($pembayaran->status_pembayaran) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-white"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-white/60">Jumlah</span>
                        <span class="font-semibold text-white">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-wallet text-white"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-white/60">Metode</span>
                        <span class="font-semibold text-white capitalize">{{ $pembayaran->metode_pembayaran }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal for Image -->
@if($pembayaran->bukti_pembayaran)
<div id="imageModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="relative max-w-4xl max-h-[90vh]">
        <button onclick="closeImageModal()"
                class="absolute -top-12 right-0 text-white hover:text-emerald-300 text-2xl">
            <i class="fas fa-times"></i>
        </button>
        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
             alt="Bukti Pembayaran"
             class="max-w-full max-h-[80vh] object-contain">
    </div>
</div>

<script>
    function openImageModal() {
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const image = document.querySelector('img[alt="Bukti Pembayaran"]');
        if (image) {
            image.addEventListener('click', openImageModal);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') {
                closeImageModal();
            }
        });
    });
</script>
@endif
@endsection
