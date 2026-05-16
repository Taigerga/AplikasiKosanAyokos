<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;
use App\Services\Analisis\AnalisisService;
use Illuminate\Support\Facades\Auth;

class PemilikDashboardController extends ApiController
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        try {
            $pemilik = Auth::user()->pemilik;
            $stats = $this->analisisService->getPemilikDashboardStats($pemilik->id_pemilik);

            return $this->success($stats);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat dashboard.', 500);
        }
    }

    public function getKosStats()
    {
        try {
            $pemilik = Auth::user()->pemilik;
            $stats = $this->analisisService->getPemilikDashboardStats($pemilik->id_pemilik);

            return $this->success([
                'total_kos' => $stats['totalKos'],
                'total_kamar' => $stats['totalKamar'],
                'kamar_tersedia' => $stats['kamarTersedia'],
                'total_penghuni' => $stats['totalPenghuni'],
                'pendapatan_bulan_ini' => $stats['pendapatanBulanIni'],
            ]);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat statistik kos.', 500);
        }
    }

    public function getPendapatanTahunan($tahun = null)
    {
        try {
            $pemilik = Auth::user()->pemilik;
            $data = $this->analisisService->getPendapatanTahunan($pemilik->id_pemilik, $tahun);

            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat data pendapatan.', 500);
        }
    }

    public function getAktivitasTerbaru()
    {
        try {
            $pemilik = Auth::user()->pemilik;
            $data = $this->analisisService->getAktivitasTerbaru($pemilik->id_pemilik);

            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat aktivitas terbaru.', 500);
        }
    }
}
