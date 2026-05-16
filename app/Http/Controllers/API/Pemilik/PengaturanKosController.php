<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Pemilik\StorePengaturanKosRequest;
use App\Http\Requests\Pemilik\UpdatePengaturanKosRequest;
use App\Models\PengaturanKos;

class PengaturanKosController extends ApiController
{
    public function index()
    {
        try {
            return $this->paginated(PengaturanKos::with('kos')->paginate(10));
        } catch (\Exception $e) {
            return $this->error('Gagal memuat data.', 500);
        }
    }

    public function showByKos($idKos)
    {
        try {
            $pengaturan = PengaturanKos::with('kos')->where('id_kos', $idKos)->first();
            if (!$pengaturan) return $this->notFound('Pengaturan tidak ditemukan');
            return $this->success($pengaturan);
        } catch (\Exception $e) {
            return $this->notFound('Pengaturan tidak ditemukan.');
        }
    }

    public function show($id)
    {
        try {
            $pengaturan = PengaturanKos::with('kos')->find($id);
            if (!$pengaturan) return $this->notFound('Pengaturan tidak ditemukan');
            return $this->success($pengaturan);
        } catch (\Exception $e) {
            return $this->notFound('Pengaturan tidak ditemukan.');
        }
    }

    public function store(StorePengaturanKosRequest $request)
    {
        try {
            $pengaturan = PengaturanKos::create($request->validated());
            return $this->created($pengaturan, 'Pengaturan berhasil dibuat');
        } catch (\Exception $e) {
            return $this->error('Gagal membuat pengaturan.', 500);
        }
    }

    public function update(UpdatePengaturanKosRequest $request, $id)
    {
        try {
            $pengaturan = PengaturanKos::findOrFail($id);
            $pengaturan->update($request->validated());
            return $this->success($pengaturan, 'Pengaturan berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui pengaturan.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            PengaturanKos::findOrFail($id)->delete();
            return $this->success(null, 'Pengaturan berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus pengaturan.', 500);
        }
    }
}
