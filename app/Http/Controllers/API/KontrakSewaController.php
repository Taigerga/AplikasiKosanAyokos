<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class KontrakSewaController extends Controller
{
    public function index()
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar', 'pembayaran', 'reviews'])->get();
        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penghuni' => 'required|exists:penghuni,id_penghuni',
            'id_kos' => 'required|exists:kos,id_kos',
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'foto_ktp' => 'nullable|string|max:255',
            'tanggal_daftar' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'durasi_sewa' => 'required|integer|min:1',
            'harga_sewa' => 'required|numeric|min:0',
            'status_kontrak' => 'required|in:pending,aktif,selesai,ditolak',
            'alasan_ditolak' => 'nullable|string'
        ]);

        $kontrak = KontrakSewa::create($validated);
        return response()->json(['success' => true, 'data' => $kontrak, 'message' => 'Kontrak Sewa created successfully'], 201);
    }

    public function show($id)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar', 'pembayaran', 'reviews'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function update(Request $request, $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        $validated = $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'durasi_sewa' => 'sometimes|integer|min:1',
            'harga_sewa' => 'sometimes|numeric|min:0',
            'status_kontrak' => 'sometimes|in:pending,aktif,selesai,ditolak',
            'alasan_ditolak' => 'nullable|string'
        ]);

        $kontrak->update($validated);
        return response()->json(['success' => true, 'data' => $kontrak, 'message' => 'Kontrak Sewa updated successfully']);
    }

    public function destroy($id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        $kontrak->delete();
        return response()->json(['success' => true, 'message' => 'Kontrak Sewa deleted successfully']);
    }
}
