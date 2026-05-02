<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KosFasilitas;
use Illuminate\Http\Request;

class KosFasilitasController extends Controller
{
    public function index()
    {
        $kosFasilitas = KosFasilitas::with(['kos', 'fasilitas'])->get();
        return response()->json(['success' => true, 'data' => $kosFasilitas]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'id_fasilitas' => 'required|exists:fasilitas,id_fasilitas',
        ]);

        // Check if already exists
        $exists = KosFasilitas::where('id_kos', $validated['id_kos'])
            ->where('id_fasilitas', $validated['id_fasilitas'])
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Fasilitas already exists for this Kos'], 422);
        }

        $kosFasilitas = KosFasilitas::create($validated);
        return response()->json(['success' => true, 'data' => $kosFasilitas, 'message' => 'Kos Fasilitas created successfully'], 201);
    }

    public function show($id)
    {
        $kosFasilitas = KosFasilitas::with(['kos', 'fasilitas'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kosFasilitas]);
    }

    public function showByKos($idKos)
    {
        $kosFasilitas = KosFasilitas::with('fasilitas')->where('id_kos', $idKos)->get();
        return response()->json(['success' => true, 'data' => $kosFasilitas]);
    }

    public function destroy($id)
    {
        $kosFasilitas = KosFasilitas::findOrFail($id);
        $kosFasilitas->delete();
        return response()->json(['success' => true, 'message' => 'Kos Fasilitas deleted successfully']);
    }
}
