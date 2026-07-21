@extends('layouts.app')

@section('title', 'Detail Pemilik - Admin AyoKos')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <a href="{{ route('admin.data-pemilik.index') }}" class="hover:text-black transition">Data Pemilik</a>
            <span>></span>
            <span class="font-black text-black">Detail</span>
        </div>
        <h1 class="text-3xl font-black text-black">Detail Pemilik</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Informasi User</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-black text-gray-500">Username</p>
                    <p class="font-bold text-lg">{{ $pemilik->user->username ?? $pemilik->username ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Role</p>
                    <span class="bg-blue-200 border-2 border-black px-2 py-1 text-xs font-black">Pemilik</span>
                </div>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Informasi Pemilik</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-black text-gray-500">Nama</p>
                    <p class="font-bold">{{ $pemilik->user->name ?? $pemilik->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Email</p>
                    <p class="font-bold">{{ $pemilik->user->email ?? $pemilik->email ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">No HP</p>
                    <p class="font-bold">{{ $pemilik->no_hp ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Jenis Kelamin</p>
                    <p class="font-bold">{{ $pemilik->jenis_kelamin ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Tanggal Lahir</p>
                    <p class="font-bold">{{ isset($pemilik->tanggal_lahir) ? \Carbon\Carbon::parse($pemilik->tanggal_lahir)->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Alamat</p>
                    <p class="font-bold">{{ $pemilik->alamat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Status</p>
                    @php
                        $statusColor = [
                            'aktif' => 'bg-green-300',
                            'nonaktif' => 'bg-gray-300',
                            'pending' => 'bg-yellow-300',
                            'dibatasi' => 'bg-orange-300',
                            'diblokir' => 'bg-red-300',
                        ];
                        $st = $pemilik->status ?? 'aktif';
                        $sc = $statusColor[$st] ?? 'bg-gray-200';
                    @endphp
                    <span class="{{ $sc }} border-2 border-black px-2 py-1 text-xs font-black">{{ ucfirst($st) }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Update Status</h2>
            <form action="{{ route('admin.data-pemilik.status', $pemilik->id_pemilik) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-black mb-1">Status</label>
                        <select name="status" class="w-full border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                            <option value="aktif" {{ $pemilik->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $pemilik->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="dibatasi" {{ $pemilik->status == 'dibatasi' ? 'selected' : '' }}>Dibatasi</option>
                            <option value="diblokir" {{ $pemilik->status == 'diblokir' ? 'selected' : '' }}>Diblokir</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-black mb-1">Alasan</label>
                    <textarea name="alasan" rows="3" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0" placeholder="Alasan (wajib jika dibatasi/diblokir)">{{ old('alasan') }}</textarea>
                </div>
                <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                    <i class="fas fa-save mr-2"></i>Update Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
