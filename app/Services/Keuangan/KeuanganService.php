<?php

namespace App\Services\Keuangan;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KeuanganService
{
    public function getRingkasanKeuangan(?int $tahun = null): array
    {
        $tahun = $tahun ?? now()->year;

        $totalPendapatanPlatform = Pembayaran::where('status_pembayaran', 'lunas')
            ->selectRaw('COALESCE(SUM(bagian_platform), 0) as total')
            ->value('total');

        $totalPendapatanTahun = Pembayaran::where('status_pembayaran', 'lunas')
            ->whereYear('tanggal_bayar', $tahun)
            ->selectRaw('COALESCE(SUM(bagian_platform), 0) as total')
            ->value('total');

        $totalPendapatanBulan = Pembayaran::where('status_pembayaran', 'lunas')
            ->whereYear('tanggal_bayar', now()->year)
            ->whereMonth('tanggal_bayar', now()->month)
            ->selectRaw('COALESCE(SUM(bagian_platform), 0) as total')
            ->value('total');

        $totalTransaksiLunas = Pembayaran::where('status_pembayaran', 'lunas')->count();
        $totalTransaksiTahun = Pembayaran::where('status_pembayaran', 'lunas')
            ->whereYear('tanggal_bayar', $tahun)->count();

        return compact(
            'totalPendapatanPlatform', 'totalPendapatanTahun', 'totalPendapatanBulan',
            'totalTransaksiLunas', 'totalTransaksiTahun'
        );
    }

    public function getPendapatanBulanan(int $tahun)
    {
        $monthFn = config('database.default') === 'sqlite'
            ? "CAST(strftime('%m', tanggal_bayar) AS INTEGER)"
            : 'MONTH(tanggal_bayar)';

        return Pembayaran::selectRaw("{$monthFn} as bulan, 
            SUM(COALESCE(bagian_pemilik, jumlah * 0.9)) as pendapatan_pemilik,
            SUM(COALESCE(bagian_platform, jumlah * 0.1)) as pendapatan_platform,
            COUNT(*) as jumlah_transaksi")
            ->where('status_pembayaran', 'lunas')
            ->whereYear('tanggal_bayar', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    }

    public function getTransaksiTerbaru(int $limit = 20)
    {
        return Pembayaran::with(['penghuni', 'kontrak.kos'])
            ->where('status_pembayaran', 'lunas')
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getStatistikPemilik()
    {
        return Pembayaran::selectRaw('
            kontrak_sewa.id_kos,
            kos.nama_kos,
            SUM(COALESCE(bagian_platform, jumlah * 0.1)) as pendapatan_platform,
            SUM(COALESCE(bagian_pemilik, jumlah * 0.9)) as pendapatan_pemilik,
            COUNT(*) as jumlah_transaksi
        ')
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->join('kos', 'kontrak_sewa.id_kos', '=', 'kos.id_kos')
            ->where('pembayaran.status_pembayaran', 'lunas')
            ->groupBy('kontrak_sewa.id_kos', 'kos.nama_kos')
            ->orderByDesc('pendapatan_platform')
            ->get();
    }

    public function getTotalPemilikBerbayar(): int
    {
        return Pembayaran::where('status_pembayaran', 'lunas')
            ->whereNotNull('bagian_platform')
            ->where('bagian_platform', '>', 0)
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->distinct('kontrak_sewa.id_kos')
            ->count('kontrak_sewa.id_kos');
    }
}
