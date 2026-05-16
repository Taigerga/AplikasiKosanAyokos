<?php

namespace App\Http\Controllers\Web\Penghuni;

use App\Http\Controllers\Controller;
use App\Services\Analisis\AnalisisService;

class AnalisisController extends Controller
{
    public function __construct(
        protected AnalisisService $analisisService
    ) {}

    public function index()
    {
        $data = $this->analisisService->getPenghuniAnalisis(
            auth()->user()->penghuni->id_penghuni
        );

        return view('penghuni.analisis.index', $data);
    }

    public function getSpendingAnalysis()
    {
        return redirect()->route('penghuni.analisis.index');
    }
}
