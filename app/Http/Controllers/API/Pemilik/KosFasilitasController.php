<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Pemilik\StoreKosFasilitasRequest;
use App\Http\Requests\Pemilik\UpdateKosFasilitasRequest;
use App\Models\KosFasilitas;

class KosFasilitasController extends ApiController
{
    public function index()
    {
        try {
            return $this->paginated(KosFasilitas::with(['kos', 'fasilitas'])->paginate(20));
        } catch (\Exception $e) {
            return $this->error('Gagal memuat data.', 500);
        }
    }

    public function showByKos($idKos)
    {
        try {
            $fasilitas = KosFasilitas::with('fasilitas')->where('id_kos', $idKos)->get();
            return $this->success($fasilitas);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat fasilitas.', 500);
        }
    }

    public function show($id)
    {
        try {
            $item = KosFasilitas::with(['kos', 'fasilitas'])->find($id);
            if (!$item) return $this->notFound('Data tidak ditemukan');
            return $this->success($item);
        } catch (\Exception $e) {
            return $this->notFound('Data tidak ditemukan.');
        }
    }

    public function store(StoreKosFasilitasRequest $request)
    {
        try {
            $item = KosFasilitas::create($request->validated());
            return $this->created($item->load(['kos', 'fasilitas']), 'Fasilitas berhasil ditambahkan');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan fasilitas.', 500);
        }
    }

    public function update(UpdateKosFasilitasRequest $request, $id)
    {
        try {
            $item = KosFasilitas::findOrFail($id);
            $item->update($request->validated());
            return $this->success($item->load(['kos', 'fasilitas']), 'Fasilitas berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui fasilitas.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            KosFasilitas::findOrFail($id)->delete();
            return $this->success(null, 'Fasilitas berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus fasilitas.', 500);
        }
    }
}
