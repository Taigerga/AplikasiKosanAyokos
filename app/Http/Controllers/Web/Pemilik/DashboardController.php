<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Analisis\AnalisisService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $stats = $this->analisisService->getPemilikDashboardStats($pemilik->id_pemilik);

        $statistics = [
            'total_kos' => $stats['totalKos'],
            'total_kamar' => $stats['totalKamar'],
            'kamar_tersedia' => $stats['kamarTersedia'],
        ];

        $kos = $stats['semuaKos'];
        $kamar = $stats['semuaKamar'];
        $kontrakPending = $stats['kontrakPending'];
        $pembayaranTerbaru = $stats['pembayaranTerbaru'];
        $pendapatanBulanIni = $stats['pendapatanBulanIni'];

        return view('pemilik.dashboard', compact(
            'user', 'pemilik', 'statistics', 'kos', 'kamar',
            'kontrakPending', 'pembayaranTerbaru', 'pendapatanBulanIni'
        ));
    }
}
