<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KontrakSewa;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKontrakController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar', 'pembayaran'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function show($id)
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar', 'pembayaran', 'reviews'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function approve($id)
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::with(['kos', 'kamar'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        if ($kontrak->status_kontrak !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Kontrak sudah diproses'
            ], 422);
        }

        $kontrak->update([
            'status_kontrak' => 'aktif',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths($kontrak->durasi_sewa)
        ]);

        // Update kamar status
        $kontrak->kamar->update(['status_kamar' => 'terisi']);

        return response()->json([
            'success' => true,
            'data' => $kontrak,
            'message' => 'Kontrak approved successfully'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        if ($kontrak->status_kontrak !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Kontrak sudah diproses'
            ], 422);
        }

        $validated = $request->validate([
            'alasan_ditolak' => 'required|string'
        ]);

        $kontrak->update([
            'status_kontrak' => 'ditolak',
            'alasan_ditolak' => $validated['alasan_ditolak']
        ]);

        return response()->json([
            'success' => true,
            'data' => $kontrak,
            'message' => 'Kontrak rejected successfully'
        ]);
    }

    public function selesai($id)
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::with('kamar')
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        if ($kontrak->status_kontrak !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Kontrak tidak dalam status aktif'
            ], 422);
        }

        $kontrak->update(['status_kontrak' => 'selesai']);

        // Update kamar status to tersedia
        $kontrak->kamar->update(['status_kamar' => 'tersedia']);

        return response()->json([
            'success' => true,
            'data' => $kontrak,
            'message' => 'Kontrak marked as completed'
        ]);
    }

    public function destroy($id)
    {
        $pemilik = Auth::user();

        $kontrak = KontrakSewa::whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        $kontrak->delete();

        return response()->json(['success' => true, 'message' => 'Kontrak deleted successfully']);
    }
}
