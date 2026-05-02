<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::with(['pemilik', 'kamar', 'fasilitas'])->get();
        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pemilik' => 'required|exists:pemilik,id_pemilik',
            'nama_kos' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'jenis_kos' => 'required|in:putra,putri,campuran',
            'tipe_sewa' => 'required|in:harian,mingguan,bulanan,tahunan',
            'foto_utama' => 'nullable|string|max:255',
            'status_kos' => 'required|in:aktif,nonaktif,pending'
        ]);

        $kos = Kos::create($validated);
        return response()->json(['success' => true, 'data' => $kos, 'message' => 'Kos created successfully'], 201);
    }

    public function show($id)
    {
        $kos = Kos::with(['pemilik', 'kamar', 'fasilitas', 'reviews'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function update(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);
        $validated = $request->validate([
            'nama_kos' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'jenis_kos' => 'sometimes|in:putra,putri,campuran',
            'tipe_sewa' => 'sometimes|in:harian,mingguan,bulanan,tahunan',
            'foto_utama' => 'nullable|string|max:255',
            'status_kos' => 'sometimes|in:aktif,nonaktif,pending'
        ]);

        $kos->update($validated);
        return response()->json(['success' => true, 'data' => $kos, 'message' => 'Kos updated successfully']);
    }

    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);
        $kos->delete();
        return response()->json(['success' => true, 'message' => 'Kos deleted successfully']);
    }
}
