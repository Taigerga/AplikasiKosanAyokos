<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikPembayaranController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        $pembayaran = Pembayaran::with(['penghuni', 'kontrak.kos', 'kontrak.kamar'])
            ->whereHas('kontrak.kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function show($id)
    {
        $pemilik = Auth::user();

        $pembayaran = Pembayaran::with(['penghuni', 'kontrak.kos', 'kontrak.kamar'])
            ->whereHas('kontrak.kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function approve($id)
    {
        $pemilik = Auth::user();

        $pembayaran = Pembayaran::with('kontrak.kos')
            ->whereHas('kontrak.kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        if ($pembayaran->status_pembayaran !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran sudah diproses'
            ], 422);
        }

        $pembayaran->update([
            'status_pembayaran' => 'lunas',
            'tanggal_bayar' => now()
        ]);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
            'message' => 'Pembayaran approved successfully'
        ]);
    }

    public function reject($id)
    {
        $pemilik = Auth::user();

        $pembayaran = Pembayaran::with('kontrak.kos')
            ->whereHas('kontrak.kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        if ($pembayaran->status_pembayaran !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran sudah diproses'
            ], 422);
        }

        $pembayaran->update([
            'status_pembayaran' => 'terlambat'
        ]);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
            'message' => 'Pembayaran rejected successfully'
        ]);
    }
}
