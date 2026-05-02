<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::with('user')->get();
        return response()->json(['success' => true, 'data' => $admin]);
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
            'status_admin' => 'required|in:aktif,nonaktif'
        ]);

        $admin = Admin::create($validated);
        return response()->json(['success' => true, 'data' => $admin, 'message' => 'Admin created successfully'], 201);
    }

    public function show($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $admin]);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|string|max:255',
            'status_admin' => 'sometimes|in:aktif,nonaktif'
        ]);

        $admin->update($validated);
        return response()->json(['success' => true, 'data' => $admin, 'message' => 'Admin updated successfully']);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json(['success' => true, 'message' => 'Admin deleted successfully']);
    }
}
