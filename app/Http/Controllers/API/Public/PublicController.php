<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\API\ApiController;

use App\Services\Kos\KosService;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class PublicController extends ApiController
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function home()
    {
        $rekomendasiKos = $this->kosService->getRecommendedKos(6);

        return $this->success($rekomendasiKos);
    }

    public function kosIndex(Request $request)
    {
        $kos = $this->kosService->getPublicKosWithFilters($request->all(), 12);
        $fasilitasList = Fasilitas::orderBy('nama_fasilitas')->get();

        return $this->success([
            'kos' => $kos->items(),
            'fasilitas' => $fasilitasList,
            'meta' => [
                'current_page' => $kos->currentPage(),
                'last_page' => $kos->lastPage(),
                'total' => $kos->total(),
            ],
        ]);
    }

    public function kosShow($id)
    {
        $kos = $this->kosService->getPublicKosDetail($id);
        $similarKos = $this->kosService->getSimilarKos($kos, 2);

        return $this->success([
            'kos' => $kos,
            'similar_kos' => $similarKos,
        ]);
    }

    public function peta()
    {
        $kos = $this->kosService->getKosForMap();

        return $this->success($kos);
    }

    public function about()
    {
        return $this->success(['page' => 'about']);
    }

    public function howto()
    {
        return $this->success(['page' => 'how-to']);
    }

    public function terms()
    {
        return $this->success(['page' => 'terms']);
    }

    public function privacy()
    {
        return $this->success(['page' => 'privacy']);
    }
}
