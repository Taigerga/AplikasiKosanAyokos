<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pendapatanBulanan = Pembayaran::where('status_pembayaran', 'lunas')
            ->selectRaw('YEAR(tanggal_bayar) as tahun, MONTH(tanggal_bayar) as bulan, SUM(total_bayar) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->take(12)
            ->get();

        $kosTerpopuler = Kos::withCount(['kontrakSewa', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->orderBy('kontrak_sewa_count', 'desc')
            ->take(5)
            ->get();

        $sebaranRole = [
            'pemilik' => User::where('role', 'pemilik')->count(),
            'penghuni' => User::where('role', 'penghuni')->count(),
        ];

        $kontrakPerBulan = KontrakSewa::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->take(12)
            ->get();

        return view('admin.laporan.index', compact(
            'pendapatanBulanan',
            'kosTerpopuler',
            'sebaranRole',
            'kontrakPerBulan'
        ));
    }
}
