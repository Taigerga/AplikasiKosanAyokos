<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends ApiController
{
    public function index()
    {
        $data = Pemilik::with('user')->paginate(10);
        return $this->paginated($data);
    }

    public function store(Request $request)
    {
        return $this->error('Create pemilik via register endpoint.', 400);
    }

    public function show($id)
    {
        $pemilik = Pemilik::with('user', 'kos')->find($id);
        if (!$pemilik) return $this->notFound('Pemilik tidak ditemukan');
        return $this->success($pemilik);
    }

    public function update(Request $request, $id)
    {
        try {
            $pemilik = Pemilik::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'no_hp' => 'required|string|max:20',
                'email' => 'required|email|max:100|unique:pemilik,email,' . $id . ',id_pemilik',
                'status_pemilik' => 'nullable|in:aktif,nonaktif,pending',
            ]);

            $pemilik->update($validated);

            return $this->success($pemilik, 'Data pemilik berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui data pemilik.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pemilik = Pemilik::findOrFail($id);
            $pemilik->user()->delete();
            $pemilik->delete();

            return $this->success(null, 'Pemilik berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus pemilik.', 500);
        }
    }
}
