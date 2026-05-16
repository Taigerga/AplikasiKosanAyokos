<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Services\Kos\KosService;

class HomeController extends Controller
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function index()
    {
        $rekomendasiKos = $this->kosService->getRecommendedKos(6);

        return view('public.home', compact('rekomendasiKos'));
    }
}
