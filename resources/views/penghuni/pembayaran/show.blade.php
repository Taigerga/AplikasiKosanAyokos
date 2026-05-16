@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="p-4 md:p-6 max-w-3xl mx-auto">
    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-emerald-300 px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-rose-300 px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
            </div>
        @endif
        <!-- Breadcrumb -->
        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('penghuni.dashboard') }}"
                            class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-gauge mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-500 text-xs mx-2"></i>
                            <a href="{{ route('penghuni.pembayaran.index') }}"
                                class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>
                                Riwayat Pembayaran
                            </a>
                        </div>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-500 text-xs mx-2"></i>
                            <span class="ml-1 text-sm font-black text-black">
                                <i class="fas fa-eye mr-2"></i>
                                Detail Pembayaran
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-black mb-2 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gray-100 border-2 border-black  flex items-center justify-center">
                        <i class="fas fa-receipt text-black text-xl"></i>
                    </div>
                    <span>Detail Pembayaran</span>
                </h1>
                <p class="text-gray-600">Informasi lengkap transaksi pembayaran kos</p>
            </div>
            <a href="{{ route('penghuni.pembayaran.index') }}"
               class="inline-flex items-center px-4 py-2 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <!-- Status Banner -->
            <div class="p-6 border-b border-black
                {{ $pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-500/10' :
                   ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-500/10' :
                   ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-rose-500/10' :
                   'bg-gray-500/10')) }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <span class="text-xs font-black text-black/70">Status Pembayaran</span>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="px-4 py-2  text-sm font-black
                                {{ $pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-50 text-emerald-600' :
                                   ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                   ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-rose-50 text-rose-600' :
                                   'bg-gray-100 text-gray-600')) }}">
                                {{ ucfirst($pembayaran->status_pembayaran) }}
                            </span>
                            <span class="text-black font-black text-xl">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <span class="text-xs text-black/70 block">No. Transaksi</span>
                        <span class="text-sm text-black font-mono">#PAY-{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Kos Information -->
                        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-home text-black mr-3"></i>
                                Informasi Kos
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nama Kos</span>
                                    <span class="font-black text-black">{{ $pembayaran->kontrak->kos->nama_kos ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Alamat</span>
                                    <span class="font-black text-black text-right">{{ $pembayaran->kontrak->kos->alamat ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Kamar</span>
                                    <span class="font-black text-black">No. {{ $pembayaran->kontrak->kamar->nomor_kamar ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-credit-card text-black mr-3"></i>
                                Metode Pembayaran
                            </h3>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 border-2 border-black  flex items-center justify-center">
                                        <i class="fas
                                            {{ $pembayaran->metode_pembayaran == 'transfer' ? 'fa-university' :
                                               ($pembayaran->metode_pembayaran == 'cash' ? 'fa-money-bill-wave' : 'fa-qrcode') }}
                                            text-black"></i>
                                    </div>
                                    <div>
                                        <span class="block font-black text-black capitalize">{{ $pembayaran->metode_pembayaran }}</span>
                                        <span class="text-xs text-gray-600">Metode yang digunakan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Payment Timeline -->
                        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-black mr-3"></i>
                                Timeline Pembayaran
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8  bg-gray-100 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-calendar text-black text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-gray-600">Jatuh Tempo</span>
                                            <span class="text-black font-black">{{ \Carbon\Carbon::parse($pembayaran->tanggal_jatuh_tempo)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1  bg-gray-100 border-2 border-black text-gray-600">Tanggal</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 
                                            {{ $pembayaran->tanggal_bayar ? 'bg-emerald-400' : 'bg-gray-100 border-2 border-black' }} flex items-center justify-center">
                                            <i class="fas
                                                {{ $pembayaran->tanggal_bayar ? 'fa-check text-emerald-400' : 'fa-clock text-black' }}
                                                text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-gray-600">Tanggal Bayar</span>
                                            <span class="text-black font-black">
                                                {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d M Y H:i') : 'Menunggu pembayaran' }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 
                                        {{ $pembayaran->tanggal_bayar ? 'bg-emerald-50 text-emerald-600' : 'bg-yellow-50 text-yellow-600' }}">
                                        {{ $pembayaran->tanggal_bayar ? 'Telah Dibayar' : 'Pending' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8  bg-gray-100 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-calendar-check text-black text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm text-gray-600">Periode</span>
                                            <span class="text-black font-black">{{ \Carbon\Carbon::createFromFormat('Y-m', $pembayaran->bulan_tahun)->format('F Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1  bg-gray-100 border-2 border-black text-gray-600">Bulan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-info-circle text-black mr-3"></i>
                                Informasi Tambahan
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600">Keterangan</span>
                                    <span class="font-black text-black text-right">{{ $pembayaran->keterangan ?? 'Tidak ada keterangan' }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600">Dibuat pada</span>
                                    <span class="font-black text-black">{{ $pembayaran->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600">Terakhir diupdate</span>
                                    <span class="font-black text-black">{{ $pembayaran->updated_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran Section -->
                @if($pembayaran->bukti_pembayaran)
                <div class="mt-8 border-t border-black pt-8">
                    <h3 class="text-lg font-black text-black mb-4 flex items-center">
                        <i class="fas fa-file-image text-black mr-3"></i>
                        Bukti Pembayaran
                    </h3>
                    <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                            <div>
                                <span class="block text-sm text-gray-600 mb-1">File Bukti Pembayaran</span>
                                <span class="text-black font-black">bukti_pembayaran_{{ $pembayaran->id_pembayaran }}.jpg</span>
                            </div>
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka di Tab Baru
                            </a>
                        </div>

                        <div class="border-2 border-black  overflow-hidden">
                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                 alt="Bukti Pembayaran"
                                 class="w-full h-auto max-h-96 object-contain bg-gray-100 border-2 border-black">
                        </div>

                        <div class="mt-4 text-xs text-gray-600 text-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Klik gambar untuk memperbesar
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-8 border-t border-black pt-8">
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 border-2 border-black  flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-image text-black text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-black text-black mb-2">Tidak Ada Bukti Pembayaran</h4>
                        <p class="text-gray-600">Bukti pembayaran belum diunggah</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-black p-6">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <div class="flex items-center space-x-2 text-gray-600">
                        <i class="fas fa-question-circle"></i>
                        <span class="text-sm">Butuh bantuan? Hubungi admin</span>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('penghuni.pembayaran.index') }}"
                           class="px-5 py-2.5 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition">
                            <i class="fas fa-list mr-2"></i>
                            Riwayat Pembayaran
                        </a>
                        @if($pembayaran->status_pembayaran == 'pending')
                        <a href="#"
                           class="px-5 py-2.5 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition">
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
            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center">
                        <i class="fas
                            {{ $pembayaran->status_pembayaran == 'lunas' ? 'fa-check-circle text-emerald-400' :
                               ($pembayaran->status_pembayaran == 'pending' ? 'fa-clock text-yellow-400' :
                               ($pembayaran->status_pembayaran == 'terlambat' ? 'fa-exclamation-circle text-rose-400' :
                               'fa-question-circle text-gray-400')) }}"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600">Status</span>
                        <span class="font-black text-black">{{ ucfirst($pembayaran->status_pembayaran) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-black"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600">Jumlah</span>
                        <span class="font-black text-black">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-wallet text-black"></i>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-600">Metode</span>
                        <span class="font-black text-black capitalize">{{ $pembayaran->metode_pembayaran }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal for Image -->
@if($pembayaran->bukti_pembayaran)
<div id="imageModal" class="fixed inset-0 bg-black/90  hidden items-center justify-center z-50 p-4">
    <div class="relative max-w-4xl max-h-[90vh]">
        <button onclick="closeImageModal()"
                class="absolute -top-12 right-0 text-black hover:text-emerald-300 text-2xl">
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
