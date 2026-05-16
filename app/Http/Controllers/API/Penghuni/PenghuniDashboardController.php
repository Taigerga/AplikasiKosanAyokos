<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Services\Analisis\AnalisisService;
use App\Services\Kontrak\KontrakService;
use Illuminate\Support\Facades\Auth;

class PenghuniDashboardController extends ApiController
{
    public function __construct(
        protected AnalisisService $analisisService,
        protected KontrakService $kontrakService
    ) {}

    public function index()
    {
        try {
            $penghuni = Auth::user()->penghuni;

            if (!$penghuni) {
                return $this->unauthorized('Anda harus login sebagai penghuni.');
            }

            $stats = $this->analisisService->getPenghuniDashboardStats($penghuni->id_penghuni);

            return $this->success($stats);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat dashboard.', 500);
        }
    }

    public function notifikasiTenggat()
    {
        try {
            $penghuni = Auth::user()->penghuni;
            $kontrakAktif = $this->kontrakService->getNotifikasiTenggat($penghuni->id_penghuni);

            return $this->success($kontrakAktif);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat notifikasi.', 500);
        }
    }
}
