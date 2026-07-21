<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kos;
use App\Models\Aduan;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        $pendapatanPerBulan = Pembayaran::where('status_pembayaran', 'lunas')
            ->selectRaw('YEAR(tanggal_bayar) as tahun, MONTH(tanggal_bayar) as bulan, SUM(bagian_platform) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->take(12)
            ->get();

        $statusKos = Kos::selectRaw('status_kos, COUNT(*) as jumlah')
            ->groupBy('status_kos')
            ->get();

        $aduanPerStatus = Aduan::selectRaw('status_aduan, COUNT(*) as jumlah')
            ->groupBy('status_aduan')
            ->get();

        $userGrowth = User::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, role, COUNT(*) as jumlah')
            ->groupBy('tahun', 'bulan', 'role')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->take(12)
            ->get();

        $sebaranRole = [
            'admin' => User::where('role', 'admin')->count(),
            'pemilik' => User::where('role', 'pemilik')->count(),
            'penghuni' => User::where('role', 'penghuni')->count(),
        ];

        $topPemilik = \App\Models\Pemilik::selectRaw('pemilik.id_pemilik, pemilik.nama, COALESCE(SUM(pembayaran.bagian_pemilik), 0) as total_pendapatan')
            ->leftJoin('kos', 'kos.id_pemilik', '=', 'pemilik.id_pemilik')
            ->leftJoin('kontrak_sewa', 'kontrak_sewa.id_kos', '=', 'kos.id_kos')
            ->leftJoin('pembayaran', function ($join) {
                $join->on('pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
                     ->where('pembayaran.status_pembayaran', 'lunas');
            })
            ->groupBy('pemilik.id_pemilik', 'pemilik.nama')
            ->orderBy('total_pendapatan', 'desc')
            ->take(5)
            ->get();

        $totalPendapatan = $pendapatanPerBulan->sum('total');
        $totalKos = Kos::count();
        $totalAduanTerbuka = Aduan::whereNotIn('status_aduan', ['selesai', 'ditolak', 'ditutup'])->count();
        $totalKontrakAktif = KontrakSewa::where('status_kontrak', 'aktif')->count();

        return view('admin.analisis.index', compact(
            'pendapatanPerBulan',
            'statusKos',
            'aduanPerStatus',
            'userGrowth',
            'sebaranRole',
            'topPemilik',
            'totalPendapatan',
            'totalKos',
            'totalAduanTerbuka',
            'totalKontrakAktif'
        ));
    }
}
