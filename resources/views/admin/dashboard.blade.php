@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-emerald-300 px-4 py-3 rounded-xl mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-500/20 backdrop-blur-sm border border-rose-500/20 text-rose-300 px-4 py-3 rounded-xl mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
        </div>
    @endif
    <!-- Welcome Section -->
    <div class="bg-gradient-to-br from-rose-900/30 to-pink-900/30 rounded-2xl p-6 border border-rose-700/50">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}!</h1>
                <p class="text-slate-300">Panel administrasi sistem AyoKos. Kelola seluruh aspek aplikasi dari sini.</p>
            </div>
            <div class="text-sm text-slate-400">
                <i class="fas fa-calendar-alt mr-2"></i>
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['total_users'] }}</h3>
            <p class="text-slate-400 text-sm">Total Users</p>
        </div>

        <!-- Total Kos -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-green-500/50 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-home text-green-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['total_kos'] }}</h3>
            <p class="text-slate-400 text-sm">Total Kos</p>
        </div>

        <!-- Kontrak Aktif -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-yellow-500/50 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-contract text-yellow-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['total_kontrak_aktif'] }}</h3>
            <p class="text-slate-400 text-sm">Kontrak Aktif</p>
        </div>

        <!-- Pembayaran Bulan Ini -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-purple-500/50 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-credit-card text-purple-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-white mb-1">Rp {{ number_format($stats['total_pembayaran_bulan_ini'], 0, ',', '.') }}</h3>
            <p class="text-slate-400 text-sm">Pembayaran Bulan Ini</p>
        </div>
    </div>

    <!-- User Distribution -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-tie text-blue-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Pemilik</h3>
            </div>
            <p class="text-3xl font-bold text-blue-400">{{ $stats['total_pemilik'] }}</p>
        </div>

        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-green-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Penghuni</h3>
            </div>
            <p class="text-3xl font-bold text-green-400">{{ $stats['total_penghuni'] }}</p>
        </div>

        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-shield text-rose-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Admin</h3>
            </div>
            <p class="text-3xl font-bold text-rose-400">{{ $stats['total_admin'] }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
        <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center gap-2 p-4 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                <i class="fas fa-users text-blue-400 text-2xl"></i>
                <span class="text-sm text-white">Kelola User</span>
            </a>
            <a href="{{ route('admin.kos.index') }}" class="flex flex-col items-center gap-2 p-4 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                <i class="fas fa-home text-green-400 text-2xl"></i>
                <span class="text-sm text-white">Kelola Kos</span>
            </a>
            <a href="{{ route('admin.kontrak.index') }}" class="flex flex-col items-center gap-2 p-4 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                <i class="fas fa-file-contract text-yellow-400 text-2xl"></i>
                <span class="text-sm text-white">Kelola Kontrak</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="flex flex-col items-center gap-2 p-4 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                <i class="fas fa-chart-bar text-purple-400 text-2xl"></i>
                <span class="text-sm text-white">Laporan</span>
            </a>
        </div>
    </div>
</div>
@endsection
