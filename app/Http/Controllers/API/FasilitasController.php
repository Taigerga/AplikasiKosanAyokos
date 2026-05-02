<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with('kos')->get();
        return response()->json(['success' => true, 'data' => $fasilitas]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas',
            'kategori' => 'required|in:umum,kamar_mandi,dapur,parkir,keamanan,lainnya',
            'icon' => 'nullable|string|max:255'
        ]);

        $fasilitas = Fasilitas::create($validated);
        return response()->json(['success' => true, 'data' => $fasilitas, 'message' => 'Fasilitas created successfully'], 201);
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::with('kos')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $fasilitas]);
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $validated = $request->validate([
            'nama_fasilitas' => 'sometimes|string|max:100|unique:fasilitas,nama_fasilitas,'.$id.',id_fasilitas',
            'kategori' => 'sometimes|in:umum,kamar_mandi,dapur,parkir,keamanan,lainnya',
            'icon' => 'nullable|string|max:255'
        ]);

        $fasilitas->update($validated);
        return response()->json(['success' => true, 'data' => $fasilitas, 'message' => 'Fasilitas updated successfully']);
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();
        return response()->json(['success' => true, 'message' => 'Fasilitas deleted successfully']);
    }
}
