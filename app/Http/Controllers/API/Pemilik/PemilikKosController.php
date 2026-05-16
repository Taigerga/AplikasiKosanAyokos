<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Pemilik\StoreKosRequest;
use App\Http\Requests\Pemilik\UpdateKosRequest;
use App\Services\Kos\KosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKosController extends ApiController
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function index(Request $request)
    {
        $pemilik = Auth::user()->pemilik;
        $kos = $this->kosService->getOwnerKos($pemilik->id_pemilik, $request->search, 12);

        return $this->paginated($kos);
    }

    public function store(StoreKosRequest $request)
    {
        $pemilik = Auth::user()->pemilik;

        $kos = $this->kosService->createKos($pemilik->id_pemilik, $request->validated());

        return $this->created($kos, 'Kos berhasil ditambahkan');
    }

    public function show($id)
    {
        $pemilik = Auth::user()->pemilik;

        try {
            $kos = $this->kosService->getKosDetail($pemilik->id_pemilik, $id);
            return $this->success($kos);
        } catch (\Exception $e) {
            return $this->notFound('Kos tidak ditemukan');
        }
    }

    public function update(UpdateKosRequest $request, $id)
    {
        $pemilik = Auth::user()->pemilik;

        try {
            $kos = $this->kosService->updateKos($pemilik->id_pemilik, $id, $request->validated());
            return $this->success($kos, 'Kos berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->notFound('Kos tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $pemilik = Auth::user()->pemilik;

        try {
            $this->kosService->deleteKos($pemilik->id_pemilik, $id);
            return $this->success(null, 'Kos berhasil dihapus');
        } catch (\Exception $e) {
            return $this->notFound('Kos tidak ditemukan');
        }
    }
}
