<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kos;
use App\Models\Aduan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_pemilik' => User::where('role', 'pemilik')->count(),
            'total_penghuni' => User::where('role', 'penghuni')->count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_kos' => Kos::count(),
            'total_aduan_open' => Aduan::whereNotIn('status_aduan', ['selesai', 'ditolak', 'ditutup'])->count(),
        ];

        $pendapatanBulanIni = Pembayaran::where('status_pembayaran', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->selectRaw('COALESCE(SUM(bagian_platform), 0) as total')
            ->value('total');

        return view('admin.dashboard', compact('stats', 'pendapatanBulanIni'));
    }
}
