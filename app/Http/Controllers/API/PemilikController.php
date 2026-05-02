<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with(['user', 'kos'])->get();
        return response()->json(['success' => true, 'data' => $pemilik]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|string|max:255',
            'status_pemilik' => 'required|in:aktif,nonaktif,pending',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50'
        ]);

        $pemilik = Pemilik::create($validated);
        return response()->json(['success' => true, 'data' => $pemilik, 'message' => 'Pemilik created successfully'], 201);
    }

    public function show($id)
    {
        $pemilik = Pemilik::with(['user', 'kos'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $pemilik]);
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|string|max:255',
            'status_pemilik' => 'sometimes|in:aktif,nonaktif,pending',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50'
        ]);

        $pemilik->update($validated);
        return response()->json(['success' => true, 'data' => $pemilik, 'message' => 'Pemilik updated successfully']);
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();
        return response()->json(['success' => true, 'message' => 'Pemilik deleted successfully']);
    }
}
