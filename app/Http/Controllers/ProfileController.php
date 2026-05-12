<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\KontrakSewa;
use App\Models\Review;

class ProfileController extends Controller
{
    // ==================== PENGHUNI ====================

    public function showPenghuni()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        $penghuni->load([
            'kontrakSewa' => function ($query) {
                $query->where('status_kontrak', 'aktif');
            },
            'reviews',
            'pembayaran' => function ($query) {
                $query->where('status_pembayaran', 'lunas');
            }
        ]);

        return view('penghuni.profile.show', compact('penghuni', 'user'));
    }

    public function editPenghuni()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;
        return view('penghuni.profile.edit', compact('penghuni', 'user'));
    }

    public function updatePenghuni(Request $request)
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:penghuni,email,' . $penghuni->id_penghuni . ',id_penghuni',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50',
        ]);

        // Update username in users table
        if ($validated['username'] !== $user->username) {
            $user->update(['username' => $validated['username']]);
        }
        unset($validated['username']);

        // Update password if filled
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }
        unset($validated['password']);

        $penghuni->update($validated);

        return redirect()->route('penghuni.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadPhotoPenghuni(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $penghuni = Auth::user()->penghuni;

        if ($penghuni->foto_profil && Storage::exists('public/' . $penghuni->foto_profil)) {
            Storage::delete('public/' . $penghuni->foto_profil);
        }

        $path = $request->file('foto_profil')->store('profiles', 'public');
        $penghuni->update(['foto_profil' => $path]);

        return response()->json([
            'success' => true,
            'url' => Storage::url($path),
            'message' => 'Foto profil berhasil diupload'
        ]);
    }

    // ==================== PEMILIK ====================

    public function showPemilik()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $totalKos = Kos::where('id_pemilik', $pemilik->id_pemilik)->count();
        $totalKamar = Kamar::whereHas('kos', function ($q) use ($pemilik) {
            $q->where('id_pemilik', $pemilik->id_pemilik);
        })->count();

        $kamarTerisi = Kamar::whereHas('kos', function ($q) use ($pemilik) {
            $q->where('id_pemilik', $pemilik->id_pemilik);
        })->where('status_kamar', 'terisi')->count();

        $totalKontrak = KontrakSewa::whereHas('kos', function ($q) use ($pemilik) {
            $q->where('id_pemilik', $pemilik->id_pemilik);
        })->where('status_kontrak', 'aktif')->count();

        $ratingKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->withAvg('reviews', 'rating')
            ->get()
            ->avg('reviews_avg_rating');

        $recentKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->withCount([
                'kamar as kamar_tersedia' => function ($q) {
                    $q->where('status_kamar', 'tersedia');
                }
            ])
            ->latest()
            ->take(3)
            ->get();

        return view('pemilik.profile.show', compact(
            'pemilik',
            'user',
            'totalKos',
            'totalKamar',
            'kamarTerisi',
            'totalKontrak',
            'ratingKos',
            'recentKos'
        ));
    }

    public function editPemilik()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        return view('pemilik.profile.edit', compact('pemilik', 'user'));
    }

    public function updatePemilik(Request $request)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:pemilik,email,' . $pemilik->id_pemilik . ',id_pemilik',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50',
        ]);

        // Update username in users table
        if ($validated['username'] !== $user->username) {
            $user->update(['username' => $validated['username']]);
        }
        unset($validated['username']);

        // Update password if filled
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }
        unset($validated['password']);

        $pemilik->update($validated);

        return redirect()->route('pemilik.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadPhotoPemilik(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pemilik = Auth::user()->pemilik;

        if ($pemilik->foto_profil && Storage::exists('public/' . $pemilik->foto_profil)) {
            Storage::delete('public/' . $pemilik->foto_profil);
        }

        $path = $request->file('foto_profil')->store('profiles', 'public');
        $pemilik->update(['foto_profil' => $path]);

        return response()->json([
            'success' => true,
            'url' => Storage::url($path),
            'message' => 'Foto profil berhasil diupload'
        ]);
    }
}