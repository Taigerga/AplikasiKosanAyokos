@extends('layouts.app')

@section('title', 'Kelola Kamar - AyoKos')

@section('content')
    <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('pemilik.dashboard') }}"
                            class="inline-flex items-center text-sm font-black text-gray-700 hover:text-black transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="{{ route('pemilik.kamar.index') }}"
                                class="inline-flex items-center text-sm font-black text-black">
                                <i class="fas fa-bed mr-2"></i>
                                Kelola Kamar
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
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                        <i class="fas fa-bed mr-3"></i>
                        Kelola Kamar</h1>
                    <p class="text-gray-700">Kelola semua kamar kos Anda di satu tempat yang terorganisir</p>
                </div>
                <a href="{{ route('pemilik.kamar.create') }}"
                    class="mt-4 md:mt-0 px-6 py-3 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kamar Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-lg font-black text-black mb-4 flex items-center">
                <i class="fas fa-filter text-sky-400 mr-3"></i>
                Filter Kamar
            </h2>
            <form method="GET" action="{{ route('pemilik.kamar.index') }}"
                class="space-y-4 md:space-y-0 md:grid md:grid-cols-4 md:gap-4">
                <div>
                    <label class="block text-sm font-black text-black mb-2">Pilih Kos</label>
                    <div class="relative">
                        <i class="fas fa-home absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="kos"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Kos</option>
                            @foreach($kos as $k)
                                <option value="{{ $k->id_kos }}" {{ request('kos') == $k->id_kos ? 'selected' : '' }}>
                                    {{ $k->nama_kos }}
                                </option>
                            @endforeach
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Status</label>
                    <div class="relative">
                        <i class="fas fa-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="status"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance
                            </option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Tipe Kamar</label>
                    <div class="relative">
                        <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="tipe"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Tipe</option>
                            <option value="Standar" {{ request('tipe') == 'Standar' ? 'selected' : '' }}>Standar</option>
                            <option value="Deluxe" {{ request('tipe') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="VIP" {{ request('tipe') == 'VIP' ? 'selected' : '' }}>VIP</option>
                            <option value="Superior" {{ request('tipe') == 'Superior' ? 'selected' : '' }}>Superior</option>
                            <option value="Ekonomi" {{ request('tipe') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-6 py-2.5 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Kamar -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-sky-400 border-2 border-black">
                        <i class="fas fa-bed text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         {{ $stats['tersedia'] }}
                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1">{{ $stats['total_kamar'] }}</h3>
                <p class="text-sm text-gray-700">Total Kamar</p>
            </div>

            <!-- Tersedia -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-400 border-2 border-black">
                        <i class="fas fa-door-open text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                        {{ $kamar->where('status_kamar', 'tersedia')->count() }}
                    </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1">{{ $stats['tersedia'] }}</h3>
                <p class="text-sm text-gray-700">Tersedia</p>
            </div>

            <!-- Terisi -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-400 border-2 border-black">
                        <i class="fas fa-users text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         {{ $stats['terisi'] }}
                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1">{{ $stats['terisi'] }}</h3>
                <p class="text-sm text-gray-700">Terisi</p>
            </div>

            <!-- Maintenance -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-400 border-2 border-black">
                        <i class="fas fa-tools text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         {{ $stats['maintenance'] }}
                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1">{{ $stats['maintenance'] }}
                 </h3>
                <p class="text-sm text-gray-700">Maintenance</p>
            </div>
        </div>

        <!-- Kamar List -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <div class="p-6 border-b-2 border-gray-200">
                <h2 class="text-lg font-black text-black flex items-center">
                    <i class="fas fa-list mr-3 text-sky-400"></i>
                    Daftar Kamar ({{ $kamar->count() }})
                </h2>
            </div>

            <div class="overflow-x-auto w-full hidden md:block">
                <table class="w-full min-w-[850px] text-left border-collapse">
                    <thead>
                        <tr class="bg-black">
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[220px]">
                                <i class="fas fa-bed mr-2"></i>Kamar & Kos
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[180px]">
                                <i class="fas fa-cogs mr-2"></i>Tipe & Fasilitas
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[140px]">
                                <i class="fas fa-money-bill-wave mr-2"></i>Harga
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[120px]">
                                <i class="fas fa-circle mr-2"></i>Status
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[160px]">
                                <i class="fas fa-edit mr-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        @forelse($kamar as $item)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="shrink-0 w-14 h-14 bg-gray-200 border-2 border-black overflow-hidden">
                                            @if($item->foto_kamar)
                                                <img src="{{ asset('storage/' . $item->foto_kamar) }}" alt="Foto Kamar"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-bed text-gray-400 text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center">
                                                <div class="text-sm font-black text-black truncate">
                                                    Kamar {{ $item->nomor_kamar }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-sky-600 font-black mt-1 truncate">
                                                {{ $item->kos->nama_kos }}
                                            </div>
                                            <div class="text-xs text-gray-700 mt-1 truncate">
                                                <i class="fas fa-ruler-combined mr-1"></i>
                                                {{ $item->luas_kamar ?? 'N/A' }} •
                                                <i class="fas fa-user mr-1"></i>
                                                {{ $item->kapasitas }} orang
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="min-w-0">
                                        <div class="mb-2">
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-xs font-black bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] text-sky-600 whitespace-nowrap">
                                                <i class="fas fa-star mr-1 text-xs"></i>
                                                {{ $item->tipe_kamar }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-700">
                                            @if($item->fasilitas_kamar)
                                                @php
                                                    if (is_array($item->fasilitas_kamar)) {
                                                        $fasilitas = $item->fasilitas_kamar;
                                                    } else {
                                                        $fasilitas = json_decode($item->fasilitas_kamar, true) ?? [];
                                                    }
                                                @endphp

                                                    @if(is_array($fasilitas) && count($fasilitas) > 0)
                                                    @foreach(array_slice($fasilitas, 0, 2) as $fasilitasItem)
                                                        <span class="inline-block text-xs px-2 py-1 bg-gray-100 border-2 border-black mr-1 mb-1 whitespace-nowrap">
                                                            <i class="fas fa-check text-emerald-400 mr-1"></i>
                                                            {{ $fasilitasItem }}
                                                        </span>
                                                    @endforeach
                                                    @if(count($fasilitas) > 2)
                                                        <span class="text-xs text-gray-500 whitespace-nowrap">
                                                            +{{ count($fasilitas) - 2 }} lagi
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-sm font-black text-black whitespace-nowrap">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-gray-500 whitespace-nowrap">
                                        per bulan
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-black border-2 border-black whitespace-nowrap
                                        {{ $item->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' :
                                        ($item->status_kamar == 'terisi' ? 'bg-blue-400 text-black' :
                                            'bg-yellow-400 text-black') }}">
                                        <i class="fas
                                            {{ $item->status_kamar == 'tersedia' ? 'fa-door-open' :
                                            ($item->status_kamar == 'terisi' ? 'fa-user-check' : 'fa-tools') }}
                                            mr-1.5 text-xs"></i>
                                        {{ ucfirst($item->status_kamar) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2 whitespace-nowrap">
                                        <a href="{{ route('pemilik.kamar.edit', $item->id_kamar) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-xs uppercase tracking-wide">
                                            <i class="fas fa-edit mr-1 text-xs"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button"
                                            data-ajax-action="/api/pemilik/kamar/{{ $item->id_kamar }}"
                                            data-ajax-method="DELETE"
                                            data-confirm="Hapus kamar {{ $item->nomor_kamar }}?"
                                            data-success-msg="Kamar berhasil dihapus"
                                            data-redirect="{{ route('pemilik.kamar.index') }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-xs uppercase tracking-wide">
                                            <i class="fas fa-trash-alt mr-1 text-xs"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 md:px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mb-4">
                                            <i class="fas fa-bed text-sky-400 text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-black text-black mb-2">Belum ada kamar</h3>
                                        <p class="text-gray-700 mb-4">Mulai tambahkan kamar pertama Anda</p>
                                        <a href="{{ route('pemilik.kamar.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Kamar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y-2 divide-gray-200">
                @forelse($kamar as $item)
                    <div class="p-4 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-14 h-14 bg-gray-200 border-2 border-black overflow-hidden">
                                @if($item->foto_kamar)
                                    <img src="{{ asset('storage/' . $item->foto_kamar) }}" alt="Foto Kamar" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-bed text-gray-400 text-lg"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-black text-black">Kamar {{ $item->nomor_kamar }}</div>
                                <div class="text-sm text-sky-600 font-black truncate">{{ $item->kos->nama_kos }}</div>
                                <div class="text-xs text-gray-700">
                                    <i class="fas fa-ruler-combined mr-1"></i>{{ $item->luas_kamar ?? 'N/A' }} <i class="fas fa-user ml-2 mr-1"></i>{{ $item->kapasitas }} orang
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-black bg-gray-200 border-2 border-black text-sky-600">
                                <i class="fas fa-star mr-1 text-xs"></i>{{ $item->tipe_kamar }}
                            </span>
                            <div class="text-right">
                                <div class="text-sm font-black text-black">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-500">per bulan</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-black border-2 border-black
                                {{ $item->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' :
                                ($item->status_kamar == 'terisi' ? 'bg-blue-400 text-black' :
                                    'bg-yellow-400 text-black') }}">
                                <i class="fas {{ $item->status_kamar == 'tersedia' ? 'fa-door-open' :
                                ($item->status_kamar == 'terisi' ? 'fa-user-check' : 'fa-tools') }} mr-1.5 text-xs"></i>
                                {{ ucfirst($item->status_kamar) }}
                            </span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('pemilik.kamar.edit', $item->id_kamar) }}" class="inline-flex items-center px-3 py-1.5 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-xs">
                                    <i class="fas fa-edit mr-1 text-xs"></i>Edit
                                </a>
                                <button type="button"
                                    data-ajax-action="/api/pemilik/kamar/{{ $item->id_kamar }}"
                                    data-ajax-method="DELETE"
                                    data-confirm="Hapus kamar {{ $item->nomor_kamar }}?"
                                    data-success-msg="Kamar berhasil dihapus"
                                    data-redirect="{{ route('pemilik.kamar.index') }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] text-xs">
                                    <i class="fas fa-trash-alt mr-1 text-xs"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <!-- Kamar List Pagination -->
        @if($kamar->hasPages())
            <div class="mt-4 px-6 py-4 bg-white border-4 border-black shadow-[4px_4px_0px_#000]">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-black text-black">{{ $kamar->firstItem() }}</span> - 
                        <span class="font-black text-black">{{ $kamar->lastItem() }}</span> dari 
                        <span class="font-black text-black">{{ $kamar->total() }}</span> kamar
                    </div>
                    <div class="flex space-x-2">
                        {{ $kamar->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
        @endif
        <!-- Back to Dashboard -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('pemilik.dashboard') }}"
                class="inline-flex items-center px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all group">
                <i class="fas fa-arrow-left mr-3 transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>


@endsection
