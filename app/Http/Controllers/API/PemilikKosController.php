<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Fasilitas;
use App\Models\KosFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKosController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        $kos = Kos::with(['kamar', 'fasilitas'])
            ->where('id_pemilik', $pemilik->id_pemilik)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function create()
    {
        $fasilitas = Fasilitas::all();
        return response()->json(['success' => true, 'data' => ['fasilitas' => $fasilitas]]);
    }

    public function store(Request $request)
    {
        $pemilik = Auth::user();

        $validated = $request->validate([
            'nama_kos' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'jenis_kos' => 'required|in:putra,putri,campuran',
            'tipe_sewa' => 'required|in:harian,mingguan,bulanan,tahunan',
            'foto_utama' => 'nullable|string|max:255',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas'
        ]);

        $validated['id_pemilik'] = $pemilik->id_pemilik;
        $validated['status_kos'] = 'pending';

        $kos = Kos::create($validated);

        // Attach fasilitas if provided
        if (isset($validated['fasilitas'])) {
            foreach ($validated['fasilitas'] as $fasilitasId) {
                KosFasilitas::create([
                    'id_kos' => $kos->id_kos,
                    'id_fasilitas' => $fasilitasId
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $kos->load('fasilitas'),
            'message' => 'Kos created successfully'
        ], 201);
    }

    public function show($id)
    {
        $pemilik = Auth::user();

        $kos = Kos::with(['kamar', 'fasilitas', 'kontrakSewa', 'reviews'])
            ->where('id_pemilik', $pemilik->id_pemilik)
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function edit($id)
    {
        $pemilik = Auth::user();

        $kos = Kos::with('fasilitas')
            ->where('id_pemilik', $pemilik->id_pemilik)
            ->findOrFail($id);

        $fasilitas = Fasilitas::all();

        return response()->json([
            'success' => true,
            'data' => [
                'kos' => $kos,
                'fasilitas' => $fasilitas
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $pemilik = Auth::user();

        $kos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->findOrFail($id);

        $validated = $request->validate([
            'nama_kos' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'jenis_kos' => 'sometimes|in:putra,putri,campuran',
            'tipe_sewa' => 'sometimes|in:harian,mingguan,bulanan,tahunan',
            'foto_utama' => 'nullable|string|max:255',
            'status_kos' => 'sometimes|in:aktif,nonaktif,pending',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas'
        ]);

        $kos->update($validated);

        // Update fasilitas if provided
        if (isset($validated['fasilitas'])) {
            // Remove old fasilitas
            KosFasilitas::where('id_kos', $kos->id_kos)->delete();
            
            // Add new fasilitas
            foreach ($validated['fasilitas'] as $fasilitasId) {
                KosFasilitas::create([
                    'id_kos' => $kos->id_kos,
                    'id_fasilitas' => $fasilitasId
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $kos->load('fasilitas'),
            'message' => 'Kos updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $pemilik = Auth::user();

        $kos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->findOrFail($id);

        $kos->delete();

        return response()->json(['success' => true, 'message' => 'Kos deleted successfully']);
    }
}
