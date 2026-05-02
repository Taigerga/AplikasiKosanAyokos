<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['kontrak', 'penghuni'])->get();
        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kontrak' => 'required|exists:kontrak_sewa,id_kontrak',
            'id_penghuni' => 'required|exists:penghuni,id_penghuni',
            'bulan_tahun' => 'required|string|max:7',
            'tanggal_mulai_sewa' => 'nullable|date',
            'tanggal_akhir_sewa' => 'nullable|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'tanggal_bayar' => 'nullable|date',
            'jumlah' => 'required|numeric|min:0',
            'denda' => 'nullable|numeric|min:0',
            'total_bayar' => 'nullable|numeric|min:0',
            'bukti_pembayaran' => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|in:transfer,cash,qris',
            'status_pembayaran' => 'required|in:belum,lunas,terlambat,pending',
            'jenis_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string'
        ]);

        $pembayaran = Pembayaran::create($validated);
        return response()->json(['success' => true, 'data' => $pembayaran, 'message' => 'Pembayaran created successfully'], 201);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['kontrak', 'penghuni'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $validated = $request->validate([
            'tanggal_bayar' => 'nullable|date',
            'jumlah' => 'sometimes|numeric|min:0',
            'denda' => 'nullable|numeric|min:0',
            'total_bayar' => 'nullable|numeric|min:0',
            'bukti_pembayaran' => 'nullable|string|max:255',
            'metode_pembayaran' => 'sometimes|in:transfer,cash,qris',
            'status_pembayaran' => 'sometimes|in:belum,lunas,terlambat,pending',
            'keterangan' => 'nullable|string'
        ]);

        $pembayaran->update($validated);
        return response()->json(['success' => true, 'data' => $pembayaran, 'message' => 'Pembayaran updated successfully']);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return response()->json(['success' => true, 'message' => 'Pembayaran deleted successfully']);
    }
}
