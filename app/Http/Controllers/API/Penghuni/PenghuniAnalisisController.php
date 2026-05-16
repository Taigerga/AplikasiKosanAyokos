<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Services\Analisis\AnalisisService;
use Illuminate\Support\Facades\Auth;

class PenghuniAnalisisController extends ApiController
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $data = $this->analisisService->getPenghuniAnalisis(
            Auth::user()->penghuni->id_penghuni
        );

        return $this->success($data);
    }

    public function getSpendingAnalysis()
    {
        $data = $this->analisisService->getPenghuniSpendingAnalysis(
            Auth::user()->penghuni->id_penghuni
        );

        return $this->success($data);
    }
}
