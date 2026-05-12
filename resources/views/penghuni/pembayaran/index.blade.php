@extends('layouts.app')

@section('title', 'Riwayat Pembayaran - AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
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
                            class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-credit-card  mr-2"></i>
                            Riwayat Pembayaran
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
                    <i class="fas fa-credit-card mr-2"></i>
                    Riwayat Pembayaran
                </h1>
                <p class="text-white/60">Kelola dan lacak semua pembayaran kos Anda</p>
            </div>

            @if($kontrakAktif->count() > 0)
                <a href="{{ route('penghuni.pembayaran.create') }}"
                    class="mt-4 md:mt-0 px-6 py-3 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white font-semibold rounded-xl hover:bg-emerald-500/30 transition-all duration-300">
                    <i class="fas fa-credit-card mr-2"></i>
                    Bayar Sekarang
                </a>
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 px-4 py-3 rounded-xl backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-300 px-4 py-3 rounded-xl backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Kontrak Aktif Section -->
    @if($kontrakAktif->count() > 0)
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-file-contract text-white mr-3"></i>
                    Kontrak Aktif
                    <span class="ml-3 bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $kontrakAktif->count() }} kontrak
                    </span>
                </h2>
            </div>

            <div class="space-y-4">
                @foreach($kontrakAktif as $kontrak)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5 hover:border-emerald-500/50 transition-all duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                    <i class="fas fa-home text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-white/60 mb-1">Kos</p>
                                    <p class="font-medium text-white truncate">{{ $kontrak->kos->nama_kos }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                    <i class="fas fa-wallet text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-white/60 mb-1">Harga Sewa</p>
                                    <p class="font-medium text-white">Rp
                                        {{ number_format($kontrak->harga_sewa, 0, ',', '.') }}/{{ $kontrak->unit_label_lower }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-white/60 mb-1">Periode</p>
                                    <p class="font-medium text-white">
                                        @if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai)
                                            {{ $kontrak->tanggal_mulai->format('d M Y') }} -
                                            {{ $kontrak->tanggal_selesai->format('d M Y') }}
                                        @else
                                            <span class="text-yellow-400">Menunggu pembayaran pertama</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-4 border-t border-white/20 mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-white/60">
                        Menampilkan {{ $kontrakAktif->firstItem() ?? 0 }} - {{ $kontrakAktif->lastItem() ?? 0 }} dari
                        {{ $kontrakAktif->total() }} kontrak
                    </div>
                    <div class="flex space-x-2">
                        {{ $kontrakAktif->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-8 text-center">
            <div class="w-16 h-16 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-home text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Tidak Ada Kontrak Aktif</h3>
            <p class="text-white/60 mb-4">Anda harus memiliki kontrak aktif untuk melakukan pembayaran.</p>
            <a href="{{ route('public.kos.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                <i class="fas fa-search mr-1"></i>
                Cari kos sekarang
            </a>
        </div>
    @endif

    <!-- Riwayat Pembayaran Table -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-white/20">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-history text-white mr-3"></i>
                Riwayat Pembayaran
            </h2>
        </div>

        @if($pembayaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5 backdrop-blur-sm">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    Bulan
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    Jumlah
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Metode
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-tag mr-2"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-cog mr-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20">
                        @foreach($pembayaran as $bayar)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-white">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m', $bayar->bulan_tahun)->format('F Y') }}
                                        </div>
                                        @if($bayar->keterangan == 'Pembayaran di muka')
                                            <div class="mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-50 text-orange-600">
                                                    <i class="fas fa-rocket mr-1 text-xs"></i>
                                                    Advance
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-white">
                                        Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600 capitalize">
                                        <i class="fas {{ $bayar->metode_pembayaran == 'transfer' ? 'fa-university' :
                                        ($bayar->metode_pembayaran == 'cash' ? 'fa-money-bill' : 'fa-qrcode') }} mr-1 text-xs">
                                        </i>
                                        {{ $bayar->metode_pembayaran }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $bayar->status_pembayaran == 'lunas' ? 'bg-emerald-50 text-emerald-600' :
                                        ($bayar->status_pembayaran == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                            ($bayar->status_pembayaran == 'terlambat' ? 'bg-red-50 text-red-600' :
                                                'bg-gray-100 text-gray-600')) }}">
                                        <i class="fas {{ $bayar->status_pembayaran == 'lunas' ? 'fa-check-circle' :
                                        ($bayar->status_pembayaran == 'pending' ? 'fa-clock' :
                                            ($bayar->status_pembayaran == 'terlambat' ? 'fa-exclamation-triangle' : 'fa-question-circle')) }} mr-1 text-xs">
                                        </i>
                                        {{ ucfirst($bayar->status_pembayaran) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm text-white/60">
                                        @if($bayar->tanggal_bayar)
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-check mr-2 text-emerald-400"></i>
                                                {{ $bayar->tanggal_bayar->format('d M Y') }}
                                            </div>
                                        @else
                                            <span class="text-white/30">-</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <a href="{{ route('penghuni.pembayaran.show', $bayar->id_pembayaran) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-lg text-sm font-medium hover:bg-emerald-500/30 transition-all duration-300">
                                        <i class="fas fa-eye mr-1 text-xs"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-white/20">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-white/60">
                        Menampilkan {{ $pembayaran->firstItem() ?? 0 }} - {{ $pembayaran->lastItem() ?? 0 }} dari
                        {{ $pembayaran->total() }} pembayaran
                    </div>
                    <div class="flex space-x-2">
                        {{ $pembayaran->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-credit-card text-white text-2xl"></i>
                </div>
                <p class="text-white/60">Belum ada riwayat pembayaran</p>
            </div>
        @endif
    </div>

    <!-- Informasi Penting -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:border-yellow-500/50 transition-all duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-file-contract text-white text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Ketentuan Pembayaran</h3>
            </div>

            <ul class="space-y-2">
                <li class="flex items-start">
                    <i class="fas fa-check text-yellow-400 mt-1 mr-3 text-sm"></i>
                    <span class="text-sm text-white/60">Pembayaran jatuh tempo setiap tanggal 1</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-yellow-400 mt-1 mr-3 text-sm"></i>
                    <span class="text-sm text-white/60">Denda keterlambatan: Rp 50.000/hari</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-yellow-400 mt=1 mr-3 text-sm"></i>
                    <span class="text-sm text-white/60">Masa tenggang: 7 hari setelah jatuh tempo</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-yellow-400 mt-1 mr-3 text-sm"></i>
                    <span class="text-sm text-white/60">Konfirmasi pembayaran maksimal 24 jam</span>
                </li>
            </ul>
        </div>

        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:border-blue-500/50 transition-all duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-credit-card text-white text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Cara Pembayaran</h3>
            </div>

            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-blue-50 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">1</span>
                    </div>
                    <span class="text-sm text-white/60">Klik tombol "Bayar Sekarang"</span>
                </div>
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-blue-50 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">2</span>
                    </div>
                    <span class="text-sm text-white/60">Upload bukti transfer/pembayaran</span>
                </div>
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-blue-50 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">3</span>
                    </div>
                    <span class="text-sm text-white/60">Tunggu konfirmasi dari pemilik</span>
                </div>
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-blue-50 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">4</span>
                    </div>
                    <span class="text-sm text-white/60">Status akan berubah menjadi "Lunas"</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-white/60 mb-1">Total Pembayaran</p>
                    <p class="text-xl font-bold text-white">
                        Rp {{ number_format($pembayaran->sum('jumlah'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                    <i class="fas fa-wallet text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-white/60 mb-1">Pembayaran Lunas</p>
                    <p class="text-xl font-bold text-emerald-400">
                        {{ $pembayaran->where('status_pembayaran', 'lunas')->count() }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-white/60 mb-1">Menunggu Konfirmasi</p>
                    <p class="text-xl font-bold text-yellow-400">
                        {{ $pembayaran->where('status_pembayaran', 'pending')->count() }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table {
        min-width: 1000px;
    }

    @media (max-width: 1024px) {
        table {
            min-width: unset;
        }
    }

    tbody tr {
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
</style>
@endsection
