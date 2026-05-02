<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniPembayaranController extends Controller
{
    public function index()
    {
        $penghuni = Auth::user();

        $pembayaran = Pembayaran::with(['kontrak.kos', 'kontrak.kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function show($id)
    {
        $penghuni = Auth::user();

        $pembayaran = Pembayaran::with(['kontrak.kos', 'kontrak.kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function create(Request $request)
    {
        $penghuni = Auth::user();

        $kontrak = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'kontrak' => $kontrak
            ]
        ]);
    }

    public function store(Request $request)
    {
        $penghuni = Auth::user();

        $validated = $request->validate([
            'id_kontrak' => 'required|exists:kontrak_sewa,id_kontrak',
            'bulan_tahun' => 'required|string|max:7',
            'tanggal_mulai_sewa' => 'nullable|date',
            'tanggal_akhir_sewa' => 'nullable|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'denda' => 'nullable|numeric|min:0',
            'total_bayar' => 'nullable|numeric|min:0',
            'bukti_pembayaran' => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|in:transfer,cash,qris',
            'jenis_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        // Verify kontrak belongs to penghuni
        $kontrak = KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($validated['id_kontrak']);

        $validated['id_penghuni'] = $penghuni->id_penghuni;
        $validated['status_pembayaran'] = 'pending';

        $pembayaran = Pembayaran::create($validated);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
            'message' => 'Pembayaran created successfully'
        ], 201);
    }
}
