<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Analisis\AnalisisService;

class AnalisisController extends Controller
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $user = auth()->user();
        $pemilik = $user->pemilik;

        $data = $this->analisisService->getPemilikAnalisis($pemilik->id_pemilik);

        return view('pemilik.analisis.index', [
            'pemilik' => $user,
            'pendapatanPerBulan' => $data['pendapatanPerBulan'],
            'statusKamar' => $data['statusKamar'],
            'jenisKos' => $data['jenisKos'],
            'statusKontrak' => $data['statusKontrak'],
            'penghuniPerKos' => $data['penghuniAktifPerKos'],
            'penghuniPerKosFull' => $data['penghuniAktifPerKosFull'],
            'tipeKamar' => $data['tipeKamar'],
            'reviewData' => $data['ratingDistribution'],
            'pendapatanPerKos' => $data['pendapatanPerKos'],
            'pendapatanPerKosFull' => $data['pendapatanPerKosFull'],
        ]);
    }
}
