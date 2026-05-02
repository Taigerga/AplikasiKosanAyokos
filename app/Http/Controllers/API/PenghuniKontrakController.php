<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KontrakSewa;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniKontrakController extends Controller
{
    public function index()
    {
        $penghuni = Auth::user();

        $kontrak = KontrakSewa::with(['kos', 'kamar', 'pembayaran', 'reviews'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function show($id)
    {
        $penghuni = Auth::user();

        $kontrak = KontrakSewa::with(['kos', 'kamar', 'pembayaran', 'reviews'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $kontrak]);
    }

    public function create(Request $request, $kosId)
    {
        $penghuni = Auth::user();
        $kos = Kos::with(['kamar' => function($query) {
            $query->where('status_kamar', 'tersedia');
        }])->findOrFail($kosId);

        return response()->json([
            'success' => true,
            'data' => [
                'kos' => $kos,
                'penghuni' => $penghuni
            ]
        ]);
    }

    public function store(Request $request)
    {
        $penghuni = Auth::user();

        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'foto_ktp' => 'nullable|string|max:255',
            'tanggal_daftar' => 'required|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'durasi_sewa' => 'required|integer|min:1',
            'harga_sewa' => 'required|numeric|min:0',
        ]);

        $validated['id_penghuni'] = $penghuni->id_penghuni;
        $validated['status_kontrak'] = 'pending';

        $kontrak = KontrakSewa::create($validated);

        return response()->json([
            'success' => true,
            'data' => $kontrak,
            'message' => 'Kontrak created successfully'
        ], 201);
    }

    public function extend(Request $request, $id)
    {
        $penghuni = Auth::user();

        $kontrak = KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        $validated = $request->validate([
            'durasi_tambahan' => 'required|integer|min:1',
        ]);

        $tanggalSelesaiBaru = $kontrak->tanggal_selesai 
            ? date('Y-m-d', strtotime($kontrak->tanggal_selesai . ' + ' . $validated['durasi_tambahan'] . ' months'))
            : date('Y-m-d', strtotime('+' . $validated['durasi_tambahan'] . ' months'));

        $kontrak->update([
            'tanggal_selesai' => $tanggalSelesaiBaru,
            'durasi_sewa' => $kontrak->durasi_sewa + $validated['durasi_tambahan']
        ]);

        return response()->json([
            'success' => true,
            'data' => $kontrak,
            'message' => 'Kontrak extended successfully'
        ]);
    }

    public function cariKos(Request $request)
    {
        $query = Kos::with(['kamar', 'fasilitas'])
            ->where('status_kos', 'aktif');

        if ($request->has('q')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_kos', 'like', '%' . $request->q . '%')
                  ->orWhere('alamat', 'like', '%' . $request->q . '%')
                  ->orWhere('kecamatan', 'like', '%' . $request->q . '%')
                  ->orWhere('kota', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->has('jenis_kos')) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        if ($request->has('tipe_sewa')) {
            $query->where('tipe_sewa', $request->tipe_sewa);
        }

        if ($request->has('harga_min')) {
            $query->whereHas('kamar', function($q) use ($request) {
                $q->where('harga', '>=', $request->harga_min);
            });
        }

        if ($request->has('harga_max')) {
            $query->whereHas('kamar', function($q) use ($request) {
                $q->where('harga', '<=', $request->harga_max);
            });
        }

        $kos = $query->paginate(10);

        return response()->json(['success' => true, 'data' => $kos]);
    }
}
