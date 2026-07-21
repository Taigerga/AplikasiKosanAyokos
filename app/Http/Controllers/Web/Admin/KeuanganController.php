<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Services\Keuangan\KeuanganService;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function __construct(
        protected KeuanganService $keuanganService
    ) {}

    public function index(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $ringkasan = $this->keuanganService->getRingkasanKeuangan($tahun);
        $pendapatanBulanan = $this->keuanganService->getPendapatanBulanan($tahun);
        $transaksiTerbaru = $this->keuanganService->getTransaksiTerbaru();
        $statistikPemilik = $this->keuanganService->getStatistikPemilik();
        $totalPemilikBerbayar = $this->keuanganService->getTotalPemilikBerbayar();

        return view('admin.keuangan.index', compact(
            'ringkasan', 'pendapatanBulanan', 'transaksiTerbaru',
            'statistikPemilik', 'totalPemilikBerbayar', 'tahun'
        ));
    }
}
