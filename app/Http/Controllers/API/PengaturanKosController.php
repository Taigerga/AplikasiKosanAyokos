<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PengaturanKos;
use Illuminate\Http\Request;

class PengaturanKosController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanKos::with('kos')->get();
        return response()->json(['success' => true, 'data' => $pengaturan]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos|unique:pengaturan_kos',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'max_tamu' => 'nullable|integer|min:0',
            'denda_keterlambatan' => 'nullable|numeric|min:0',
            'grace_period' => 'nullable|integer|min:0',
            'auto_reject' => 'boolean',
            'notification_enabled' => 'boolean',
        ]);

        $pengaturan = PengaturanKos::create($validated);
        return response()->json(['success' => true, 'data' => $pengaturan, 'message' => 'Pengaturan Kos created successfully'], 201);
    }

    public function show($id)
    {
        $pengaturan = PengaturanKos::with('kos')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $pengaturan]);
    }

    public function showByKos($idKos)
    {
        $pengaturan = PengaturanKos::with('kos')->where('id_kos', $idKos)->firstOrFail();
        return response()->json(['success' => true, 'data' => $pengaturan]);
    }

    public function update(Request $request, $id)
    {
        $pengaturan = PengaturanKos::findOrFail($id);
        $validated = $request->validate([
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'max_tamu' => 'nullable|integer|min:0',
            'denda_keterlambatan' => 'nullable|numeric|min:0',
            'grace_period' => 'nullable|integer|min:0',
            'auto_reject' => 'boolean',
            'notification_enabled' => 'boolean',
        ]);

        $pengaturan->update($validated);
        return response()->json(['success' => true, 'data' => $pengaturan, 'message' => 'Pengaturan Kos updated successfully']);
    }

    public function destroy($id)
    {
        $pengaturan = PengaturanKos::findOrFail($id);
        $pengaturan->delete();
        return response()->json(['success' => true, 'message' => 'Pengaturan Kos deleted successfully']);
    }
}
