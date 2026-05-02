<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    public function index()
    {
        $penghuni = Penghuni::with(['user', 'kontrakSewa', 'pembayaran', 'reviews'])->get();
        return response()->json(['success' => true, 'data' => $penghuni]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|string|max:255',
            'status_penghuni' => 'required|in:calon,aktif,nonaktif,ditolak'
        ]);

        $penghuni = Penghuni::create($validated);
        return response()->json(['success' => true, 'data' => $penghuni, 'message' => 'Penghuni created successfully'], 201);
    }

    public function show($id)
    {
        $penghuni = Penghuni::with(['user', 'kontrakSewa', 'pembayaran', 'reviews'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $penghuni]);
    }

    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_kelamin' => 'sometimes|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|string|max:255',
            'status_penghuni' => 'sometimes|in:calon,aktif,nonaktif,ditolak'
        ]);

        $penghuni->update($validated);
        return response()->json(['success' => true, 'data' => $penghuni, 'message' => 'Penghuni updated successfully']);
    }

    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $penghuni->delete();
        return response()->json(['success' => true, 'message' => 'Penghuni deleted successfully']);
    }
}
