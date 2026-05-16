<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Services\Analisis\AnalisisService;
use Illuminate\Support\Facades\Auth;

class PemilikAnalisisController extends ApiController
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        $data = $this->analisisService->getPemilikAnalisis($pemilik->id_pemilik);

        return $this->success([
            'pendapatan_per_bulan' => $data['pendapatanPerBulan'],
            'status_kamar' => $data['statusKamar'],
            'jenis_kos' => $data['jenisKos'],
            'status_kontrak' => $data['statusKontrak'],
            'penghuni_aktif_per_kos' => $data['penghuniAktifPerKos']->items(),
            'tipe_kamar' => $data['tipeKamar'],
            'rating_distribution' => $data['ratingDistribution'],
            'pendapatan_per_kos' => $data['pendapatanPerKos']->items(),
        ]);
    }
}
