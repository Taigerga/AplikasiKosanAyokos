<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Services\Kos\KosService;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function index(Request $request)
    {
        $kos = $this->kosService->getPublicKosWithFilters($request->all(), 12);
        $fasilitasList = Fasilitas::orderBy('nama_fasilitas')->get();

        return view('public.kos.index', compact('kos', 'fasilitasList'));
    }

    public function show($id)
    {
        $kos = $this->kosService->getPublicKosDetail($id);

        $totalReviews = $kos->reviews->count();
        $averageRating = $kos->reviews->avg('rating');

        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $kos->reviews->where('rating', $i)->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => round($percentage, 1),
            ];
        }

        $similarKos = $this->kosService->getSimilarKos($kos, 2);

        return view('public.kos.show', compact('kos', 'totalReviews', 'averageRating', 'ratingDistribution', 'similarKos'));
    }

    public function peta()
    {
        $kos = $this->kosService->getKosForMap();

        return view('public.kos.peta', compact('kos'));
    }
}
