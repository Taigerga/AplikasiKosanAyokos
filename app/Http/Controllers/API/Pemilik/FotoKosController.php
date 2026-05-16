<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;
use App\Services\Kos\FotoKosService;
use Illuminate\Http\Request;

class FotoKosController extends ApiController
{
    public function __construct(
        protected FotoKosService $fotoKosService
    ) {}

    public function index()
    {
        try {
            return $this->paginated($this->fotoKosService->getAll());
        } catch (\Exception $e) {
            return $this->error('Gagal memuat daftar foto.', 500);
        }
    }

    public function showByKos($idKos)
    {
        try {
            $foto = $this->fotoKosService->getByKos($idKos);
            return $this->success($foto);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat foto.', 500);
        }
    }

    public function show($id)
    {
        try {
            $foto = $this->fotoKosService->getById($id);
            if (!$foto) return $this->notFound('Foto tidak ditemukan');
            return $this->success($foto);
        } catch (\Exception $e) {
            return $this->notFound('Foto tidak ditemukan.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_kos' => 'required|exists:kos,id_kos',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $foto = $this->fotoKosService->create($request->all(), $request->file('foto'));

            return $this->created($foto, 'Foto berhasil ditambahkan');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan foto.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        return $this->error('Update not supported. Delete and re-upload.', 400);
    }

    public function destroy($id)
    {
        try {
            $this->fotoKosService->delete($id);
            return $this->success(null, 'Foto berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus foto.', 500);
        }
    }
}
