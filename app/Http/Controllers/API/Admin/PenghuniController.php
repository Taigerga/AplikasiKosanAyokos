<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends ApiController
{
    public function index()
    {
        $data = Penghuni::with('user')->paginate(10);
        return $this->paginated($data);
    }

    public function store(Request $request)
    {
        return $this->error('Create penghuni via register endpoint.', 400);
    }

    public function show($id)
    {
        $penghuni = Penghuni::with('user', 'kontrakSewa')->find($id);
        if (!$penghuni) return $this->notFound('Penghuni tidak ditemukan');
        return $this->success($penghuni);
    }

    public function update(Request $request, $id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'no_hp' => 'required|string|max:20',
                'email' => 'required|email|max:100|unique:penghuni,email,' . $id . ',id_penghuni',
                'status_penghuni' => 'nullable|in:aktif,nonaktif,calon',
            ]);

            $penghuni->update($validated);

            return $this->success($penghuni, 'Data penghuni berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui data penghuni.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);
            $penghuni->user()->delete();
            $penghuni->delete();

            return $this->success(null, 'Penghuni berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus penghuni.', 500);
        }
    }
}
