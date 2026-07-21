@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    @if(session('success'))
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
        </div>
    @endif

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-black mb-2">Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}!</h1>
                <p class="text-gray-700 font-bold">Panel administrasi sistem AyoKos. Kelola seluruh aspek aplikasi dari sini.</p>
            </div>
            <div class="text-sm text-gray-600 font-black bg-yellow-400 border-2 border-black px-3 py-2">
                <i class="fas fa-calendar-alt mr-2"></i>
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-sky-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-users text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1">{{ $stats['total_users'] }}</h3>
            <p class="text-gray-600 font-bold text-sm">Total User</p>
            <div class="mt-2 space-y-1 text-xs font-bold text-gray-500">
                <div class="flex justify-between"><span>Admin</span><span class="font-black">: {{ $stats['total_admin'] }}</span></div>
                <div class="flex justify-between"><span>Pemilik</span><span class="font-black">: {{ $stats['total_pemilik'] }}</span></div>
                <div class="flex justify-between"><span>Penghuni</span><span class="font-black">: {{ $stats['total_penghuni'] }}</span></div>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-emerald-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-home text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1">{{ $stats['total_kos'] }}</h3>
            <p class="text-gray-600 font-bold text-sm">Total Kos</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-rose-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-headset text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1">{{ $stats['total_aduan_open'] }}</h3>
            <p class="text-gray-600 font-bold text-sm">Aduan Terbuka</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-orange-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-coins text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
            <p class="text-gray-600 font-bold text-sm">Pendapatan Platform (10%)</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h3 class="text-lg font-black text-black mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center gap-2 p-4 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-users text-2xl"></i>
                <span class="text-sm">Kelola User</span>
            </a>
            <a href="{{ route('admin.kos.index') }}" class="flex flex-col items-center gap-2 p-4 bg-emerald-400 hover:bg-emerald-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-home text-2xl"></i>
                <span class="text-sm">Kelola Kos</span>
            </a>
            <a href="{{ route('admin.aduan.index') }}" class="flex flex-col items-center gap-2 p-4 bg-rose-400 hover:bg-rose-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-headset text-2xl"></i>
                <span class="text-sm">Kelola Aduan</span>
            </a>
            <a href="{{ route('admin.keuangan.index') }}" class="flex flex-col items-center gap-2 p-4 bg-orange-400 hover:bg-orange-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-coins text-2xl"></i>
                <span class="text-sm">Keuangan</span>
            </a>
        </div>
    </div>
</div>
@endsection
