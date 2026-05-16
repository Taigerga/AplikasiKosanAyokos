<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\User;
use App\Models\Kos;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;

class AdminDashboardController extends ApiController
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_pemilik' => User::where('role', 'pemilik')->count(),
            'total_penghuni' => User::where('role', 'penghuni')->count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_kos' => Kos::count(),
            'total_kontrak_aktif' => KontrakSewa::where('status_kontrak', 'aktif')->count(),
            'total_pembayaran_bulan_ini' => Pembayaran::whereMonth('tanggal_bayar', now()->month)
                ->whereYear('tanggal_bayar', now()->year)
                ->sum('jumlah'),
        ];

        return $this->success($stats);
    }
}
