@extends('layouts.app')

@section('title', 'Kelola Kos - AyoKos')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('pemilik.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="{{ route('pemilik.kos.index') }}"
                                class="inline-flex items-center text-sm font-medium text-black">
                                <i class="fas fa-file-contract mr-2"></i>
                                Kelola Kos
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Kelola Kos</h1>
                    <p class="text-gray-600">Kelola semua properti kos Anda di satu tempat</p>
                </div>
                <a href="{{ route('pemilik.kos.create') }}"
                    class="mt-4 md:mt-0 px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kos Baru
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <form method="GET" action="{{ route('pemilik.kos.index') }}">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-3 bg-white border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none"
                                placeholder="Cari nama kos, alamat, kecamatan, atau kota...">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('pemilik.kos.index') }}"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                                <i class="fas fa-times mr-2"></i>
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Kos List -->
        @if($kos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kos as $item)
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden transition-all duration-300">
                        <!-- Foto Kos -->
                        <div class="relative h-56 overflow-hidden">
                            @if($item->foto_utama)
                                <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_kos }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-home text-4xl text-gray-400"></i>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 text-xs font-black border-2 border-black
                                    {{ $item->status_kos == 'aktif' ? 'bg-emerald-400 text-black' :
                            ($item->status_kos == 'pending' ? 'bg-yellow-400 text-black' :
                                'bg-red-400 text-black') }}">
                                    {{ ucfirst($item->status_kos) }}
                                </span>
                            </div>

                            <!-- Overlay on Hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Info Kos -->
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-lg font-semibold text-black truncate">{{ $item->nama_kos }}</h3>
                            </div>

                            <div class="flex items-center text-gray-600 text-sm mb-3">
                                <i class="fas fa-map-marker-alt mr-2 text-cyan-600"></i>
                                <span class="line-clamp-1">{{ $item->alamat }}</span>
                            </div>

                            <div class="flex items-center justify-between text-sm mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-600">
                                        <i class="fas fa-bed mr-2 text-emerald-600"></i>
                                        {{ $item->kamar_count }} Kamar
                                    </span>
                                    <span class="flex items-center text-gray-600">
                                        <i class="fas fa-users mr-2 text-cyan-600"></i>
                                        {{ ucfirst($item->jenis_kos) }}
                                    </span>
                                </div>
                                <span class="font-bold text-gray-900">
                                    {{ ucfirst($item->tipe_sewa) }}
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t-2 border-gray-200">
                                <!-- Left Side: Detail Button -->
                                <a href="{{ route('pemilik.kos.show', $item->id_kos) }}"
                                    class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                    <i class="fas fa-eye mr-2 group-hover:scale-110 transition-transform"></i>
                                    Detail
                                </a>

                                <!-- Right Side: Edit, Kamar, Delete -->
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('pemilik.kos.edit', $item->id_kos) }}"
                                        class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                                        Edit
                                    </a>

                                    <a href="{{ route('pemilik.kamar.index', ['kos' => $item->id_kos]) }}"
                                        class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                        <i class="fas fa-bed mr-2 group-hover:scale-110 transition-transform"></i>
                                        Kamar
                                    </a>

                                    <button type="button"
                                        data-ajax-action="/api/pemilik/kos/{{ $item->id_kos }}"
                                        data-ajax-method="DELETE"
                                        data-confirm="Hapus kos {{ $item->nama_kos }}? Semua data terkait akan terhapus permanen."
                                        data-success-msg="Kos berhasil dihapus"
                                        data-redirect="{{ route('pemilik.kos.index') }}"
                                        class="inline-flex items-center text-red-600 hover:text-black font-black transition-colors group">
                                        <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] p-8">
                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-white border-2 border-black flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-4xl text-black"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-black mb-3">Belum Ada Kos</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Mulai dengan menambahkan kos pertama Anda untuk mengelola properti Anda
                    </p>
                    <a href="{{ route('pemilik.kos.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kos Pertama
                    </a>
                </div>
            </div>
        @endif

            <!-- Table Footer -->
        @if($kos->hasPages())
            <div class="px-6 py-4 border-t-2 border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $kos->firstItem() }} - {{ $kos->lastItem() }} dari {{ $kos->total() }} kos
                    </div>
                    <div class="flex space-x-2">
                        {{ $kos->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Back to Dashboard -->
    <div class="flex justify-center pt-6">
        <a href="{{ route('pemilik.dashboard') }}"
            class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Dashboard
        </a>
    </div>


@endsection
