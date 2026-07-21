@extends('layouts.app')

@section('title', 'Kelola Kos - Admin AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Kelola Kos</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-black"><i class="fas fa-home mr-3 text-emerald-500"></i>Daftar Kos</h2>
        </div>

        <form method="GET" class="flex flex-col md:flex-row gap-3 mb-6">
            <select name="status" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            <input type="text" name="search" placeholder="Cari nama kos..." value="{{ request('search') }}" class="border-2 border-black px-3 py-2 font-bold text-sm flex-1">
            <button type="submit" class="bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] px-4 py-2 font-bold text-sm hover:shadow-[4px_4px_0px_#000] transition-all">
                <i class="fas fa-search mr-1"></i>Cari
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Nama Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Pemilik</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kota</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Jenis</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kosList as $kos)
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold">{{ $kos->id_kos }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold">{{ $kos->nama_kos }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">{{ $kos->pemilik->nama ?? '-' }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">{{ $kos->kota ?? '-' }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">{{ ucfirst($kos->jenis_kos) }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                @php
                                    $statusColors = ['aktif' => 'bg-emerald-400', 'nonaktif' => 'bg-red-400', 'pending' => 'bg-yellow-400'];
                                @endphp
                                <span class="{{ $statusColors[$kos->status_kos] ?? 'bg-gray-400' }} border-2 border-black px-2 py-1 text-xs font-bold">{{ ucfirst($kos->status_kos) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-home text-3xl block mb-2"></i>Tidak ada kos ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $kosList->links('vendor.pagination.custom-dark') }}</div>
    </div>
</div>
@endsection
