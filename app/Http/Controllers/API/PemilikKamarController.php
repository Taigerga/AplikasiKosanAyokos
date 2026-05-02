<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKamarController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        $kamar = Kamar::with('kos')
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $kamar]);
    }

    public function create()
    {
        $pemilik = Auth::user();

        $kos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->where('status_kos', '!=', 'pending')
            ->get();

        return response()->json(['success' => true, 'data' => ['kos' => $kos]]);
    }

    public function store(Request $request)
    {
        $pemilik = Auth::user();

        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'nomor_kamar' => 'required|string|max:10',
            'tipe_kamar' => 'required|in:Standar,Deluxe,VIP,Superior,Ekonomi',
            'harga' => 'required|numeric|min:0',
            'luas_kamar' => 'nullable|string|max:20',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas_kamar' => 'nullable|string',
            'foto_kamar' => 'nullable|string|max:255',
            'status_kamar' => 'required|in:tersedia,terisi,maintenance'
        ]);

        // Verify kos belongs to pemilik
        $kos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->findOrFail($validated['id_kos']);

        $kamar = Kamar::create($validated);

        return response()->json([
            'success' => true,
            'data' => $kamar,
            'message' => 'Kamar created successfully'
        ], 201);
    }

    public function show($id)
    {
        $pemilik = Auth::user();

        $kamar = Kamar::with(['kos', 'kontrakSewa'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $kamar]);
    }

    public function edit($id)
    {
        $pemilik = Auth::user();

        $kamar = Kamar::with('kos')
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        $kos = Kos::where('id_pemilik', $pemilik->id_pemilik)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'kamar' => $kamar,
                'kos' => $kos
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $pemilik = Auth::user();

        $kamar = Kamar::whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        $validated = $request->validate([
            'nomor_kamar' => 'sometimes|string|max:10',
            'tipe_kamar' => 'sometimes|in:Standar,Deluxe,VIP,Superior,Ekonomi',
            'harga' => 'sometimes|numeric|min:0',
            'luas_kamar' => 'nullable|string|max:20',
            'kapasitas' => 'sometimes|integer|min:1',
            'fasilitas_kamar' => 'nullable|string',
            'foto_kamar' => 'nullable|string|max:255',
            'status_kamar' => 'sometimes|in:tersedia,terisi,maintenance'
        ]);

        $kamar->update($validated);

        return response()->json([
            'success' => true,
            'data' => $kamar,
            'message' => 'Kamar updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $pemilik = Auth::user();

        $kamar = Kamar::whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        $kamar->delete();

        return response()->json(['success' => true, 'message' => 'Kamar deleted successfully']);
    }
}
