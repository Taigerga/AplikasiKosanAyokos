<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::with(['kos', 'kontrakSewa'])->get();
        return response()->json(['success' => true, 'data' => $kamar]);
    }

    public function store(Request $request)
    {
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

        $kamar = Kamar::create($validated);
        return response()->json(['success' => true, 'data' => $kamar, 'message' => 'Kamar created successfully'], 201);
    }

    public function show($id)
    {
        $kamar = Kamar::with(['kos', 'kontrakSewa'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kamar]);
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        $validated = $request->validate([
            'id_kos' => 'sometimes|exists:kos,id_kos',
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
        return response()->json(['success' => true, 'data' => $kamar, 'message' => 'Kamar updated successfully']);
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();
        return response()->json(['success' => true, 'message' => 'Kamar deleted successfully']);
    }
}
