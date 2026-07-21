@extends('layouts.app')

@section('title', 'Kelola Aduan - Admin AyoKos')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <span class="font-black text-black">Aduan</span>
        </div>
        <h1 class="text-3xl font-black text-black">Kelola Aduan</h1>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-600 uppercase">Total</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['total'] ?? 0 }}</p>
        </div>
        <div class="bg-yellow-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Diajukan</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['diajukan'] ?? 0 }}</p>
        </div>
        <div class="bg-blue-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Ditinjau</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['ditinjau'] ?? 0 }}</p>
        </div>
        <div class="bg-orange-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Diproses</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['diproses'] ?? 0 }}</p>
        </div>
        <div class="bg-green-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Selesai</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['selesai'] ?? 0 }}</p>
        </div>
        <div class="bg-red-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Ditolak</p>
            <p class="text-2xl font-black mt-1">{{ $statistik['ditolak'] ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <form method="GET" action="{{ route('admin.aduan.index') }}" class="flex flex-wrap gap-4 mb-6">
            <div>
                <label class="block text-sm font-black mb-1">Status</label>
                <select name="status" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Status</option>
                    <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="ditinjau" {{ request('status') == 'ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="menunggu_info" {{ request('status') == 'menunggu_info' ? 'selected' : '' }}>Menunggu Info</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="ditutup" {{ request('status') == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-black mb-1">Kategori</label>
                <select name="kategori" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-black mb-1">Role</label>
                <select name="role" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Role</option>
                    <option value="penghuni" {{ request('role') == 'penghuni' ? 'selected' : '' }}>Penghuni</option>
                    <option value="pemilik" {{ request('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                </select>
            </div>
            <div class="self-end">
                <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">No</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Judul</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Kategori</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pengirim</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Status</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Tanggal</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aduans as $i => $aduan)
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-bold">{{ $aduan->judul }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-gray-200 border-2 border-black px-2 py-1 text-xs font-black">{{ $aduan->kategori }}</span>
                            </td>
                            <td class="px-4 py-3 font-bold">{{ $aduan->pengirim->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'diajukan' => 'bg-yellow-300',
                                        'ditinjau' => 'bg-blue-300',
                                        'diproses' => 'bg-orange-300',
                                        'menunggu_info' => 'bg-purple-300',
                                        'selesai' => 'bg-green-300',
                                        'ditolak' => 'bg-red-300',
                                        'ditutup' => 'bg-gray-300',
                                    ];
                                    $color = $statusColors[$aduan->status] ?? 'bg-gray-200';
                                @endphp
                                <span class="{{ $color }} border-2 border-black px-2 py-1 text-xs font-black">{{ ucfirst($aduan->status) }}</span>
                            </td>
                            <td class="px-4 py-3 font-bold">{{ $aduan->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.aduan.show', $aduan->id_aduan) }}" class="bg-black text-white font-black px-3 py-1 text-sm border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[1px_1px_0px_#000] transition-all inline-block">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center font-bold text-gray-500">Belum ada aduan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $aduans->links() }}
        </div>
    </div>
</div>
@endsection
