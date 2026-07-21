<?php

namespace App\Http\Controllers\API\Keuangan;

use App\Http\Controllers\API\ApiController;
use App\Services\Keuangan\KeuanganService;
use Illuminate\Http\Request;

class KeuanganController extends ApiController
{
    public function __construct(
        protected KeuanganService $keuanganService
    ) {}

    public function ringkasan(Request $request)
    {
        try {
            $tahun = $request->tahun ?? now()->year;
            return $this->success($this->keuanganService->getRingkasanKeuangan($tahun));
        } catch (\Exception $e) {
            return $this->error('Gagal memuat ringkasan keuangan.', 500);
        }
    }

    public function pendapatanBulanan(Request $request)
    {
        try {
            $tahun = $request->tahun ?? now()->year;
            return $this->success($this->keuanganService->getPendapatanBulanan($tahun));
        } catch (\Exception $e) {
            return $this->error('Gagal memuat data pendapatan.', 500);
        }
    }

    public function transaksiTerbaru()
    {
        try {
            return $this->success($this->keuanganService->getTransaksiTerbaru());
        } catch (\Exception $e) {
            return $this->error('Gagal memuat transaksi terbaru.', 500);
        }
    }

    public function statistikPemilik()
    {
        try {
            return $this->success($this->keuanganService->getStatistikPemilik());
        } catch (\Exception $e) {
            return $this->error('Gagal memuat statistik pemilik.', 500);
        }
    }
}
