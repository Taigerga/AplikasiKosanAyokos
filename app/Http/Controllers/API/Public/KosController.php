<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\API\ApiController;

use App\Services\Kos\KosService;
use Illuminate\Http\Request;

class KosController extends ApiController
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function index(Request $request)
    {
        $kos = $this->kosService->getPublicKosWithFilters($request->all(), 12);

        return $this->paginated($kos);
    }

    public function show($id)
    {
        try {
            $kos = $this->kosService->getPublicKosDetail($id);
            return $this->success($kos);
        } catch (\Exception $e) {
            return $this->notFound('Kos tidak ditemukan');
        }
    }
}
