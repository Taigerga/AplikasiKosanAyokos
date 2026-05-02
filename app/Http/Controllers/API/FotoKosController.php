<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FotoKos;
use Illuminate\Http\Request;

class FotoKosController extends Controller
{
    public function index()
    {
        $fotoKos = FotoKos::with('kos')->get();
        return response()->json(['success' => true, 'data' => $fotoKos]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'foto' => 'required|string|max:255',
            'is_utama' => 'boolean',
        ]);

        $fotoKos = FotoKos::create($validated);
        return response()->json(['success' => true, 'data' => $fotoKos, 'message' => 'Foto Kos created successfully'], 201);
    }

    public function show($id)
    {
        $fotoKos = FotoKos::with('kos')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $fotoKos]);
    }

    public function showByKos($idKos)
    {
        $fotoKos = FotoKos::where('id_kos', $idKos)->get();
        return response()->json(['success' => true, 'data' => $fotoKos]);
    }

    public function update(Request $request, $id)
    {
        $fotoKos = FotoKos::findOrFail($id);
        $validated = $request->validate([
            'foto' => 'sometimes|string|max:255',
            'is_utama' => 'boolean',
        ]);

        $fotoKos->update($validated);
        return response()->json(['success' => true, 'data' => $fotoKos, 'message' => 'Foto Kos updated successfully']);
    }

    public function destroy($id)
    {
        $fotoKos = FotoKos::findOrFail($id);
        $fotoKos->delete();
        return response()->json(['success' => true, 'message' => 'Foto Kos deleted successfully']);
    }
}
