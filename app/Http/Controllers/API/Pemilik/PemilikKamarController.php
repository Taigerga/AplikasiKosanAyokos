<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Pemilik\StoreKamarRequest;
use App\Http\Requests\Pemilik\UpdateKamarRequest;
use App\Services\Kamar\KamarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKamarController extends ApiController
{
    public function __construct(
        protected KamarService $kamarService
    ) {}

    public function index(Request $request)
    {
        $pemilik = Auth::user()->pemilik;
        $result = $this->kamarService->getOwnerKamar($pemilik->id_pemilik, $request->only(['kos', 'status', 'tipe']), 10);

        return $this->success([
            'kamar' => $result['kamar']->items(),
            'stats' => $result['stats'],
            'meta' => [
                'current_page' => $result['kamar']->currentPage(),
                'last_page' => $result['kamar']->lastPage(),
                'total' => $result['kamar']->total(),
            ],
        ]);
    }

    public function store(StoreKamarRequest $request)
    {
        $validated = $request->validated();

        if (!$this->kamarService->isNomorKamarUnique($validated['id_kos'], $validated['nomor_kamar'])) {
            return $this->validationError(['nomor_kamar' => 'Nomor kamar sudah ada di kos ini.']);
        }

        $kamar = $this->kamarService->createKamar($validated);

        return $this->created($kamar, 'Kamar berhasil ditambahkan');
    }

    public function show($id)
    {
        $pemilik = Auth::user()->pemilik;

        try {
            $kamar = $this->kamarService->findKamar($pemilik->id_pemilik, $id);
            return $this->success($kamar);
        } catch (\Exception $e) {
            return $this->notFound('Kamar tidak ditemukan');
        }
    }

    public function update(UpdateKamarRequest $request, $id)
    {
        $pemilik = Auth::user()->pemilik;

        $validated = $request->validated();

        if (!$this->kamarService->isNomorKamarUnique($validated['id_kos'], $validated['nomor_kamar'], $id)) {
            return $this->validationError(['nomor_kamar' => 'Nomor kamar sudah ada di kos ini.']);
        }

        try {
            $kamar = $this->kamarService->updateKamar($pemilik->id_pemilik, $id, $validated);
            return $this->success($kamar, 'Kamar berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->notFound('Kamar tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $pemilik = Auth::user()->pemilik;

        try {
            $this->kamarService->deleteKamar($pemilik->id_pemilik, $id);
            return $this->success(null, 'Kamar berhasil dihapus');
        } catch (\Exception $e) {
            return $this->notFound('Kamar tidak ditemukan');
        }
    }
}
