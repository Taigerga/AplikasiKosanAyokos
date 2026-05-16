<?php

namespace App\Services\Profile;

use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\KontrakSewa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function getPenghuniProfileData(int $userId): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $penghuni = $user->penghuni;

        $penghuni->load([
            'kontrakSewa' => fn($q) => $q->where('status_kontrak', 'aktif'),
            'reviews',
            'pembayaran' => fn($q) => $q->where('status_pembayaran', 'lunas'),
        ]);

        return compact('penghuni', 'user');
    }

    public function updatePenghuni(int $userId, array $data): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $penghuni = $user->penghuni;

        if (!empty($data['username']) && $data['username'] !== $user->username) {
            $user->update(['username' => $data['username']]);
        }

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        unset($data['username'], $data['password'], $data['password_confirmation']);

        $penghuni->update($data);

        return compact('penghuni', 'user');
    }

    public function uploadPhotoPenghuni(int $userId, $file): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $penghuni = $user->penghuni;

        if ($penghuni->foto_profil && Storage::exists('public/' . $penghuni->foto_profil)) {
            Storage::delete('public/' . $penghuni->foto_profil);
        }

        $path = $file->store('profiles', 'public');
        $penghuni->update(['foto_profil' => $path]);

        return ['url' => Storage::url($path)];
    }

    public function getPemilikProfileData(int $userId): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $pemilik = $user->pemilik;

        $totalKos = Kos::where('id_pemilik', $pemilik->id_pemilik)->count();
        $totalKamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilik->id_pemilik))->count();
        $kamarTerisi = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilik->id_pemilik))
            ->where('status_kamar', 'terisi')->count();
        $totalKontrak = KontrakSewa::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilik->id_pemilik))
            ->where('status_kontrak', 'aktif')->count();
        $ratingKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->withAvg('reviews', 'rating')->get()->avg('reviews_avg_rating');

        $recentKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->withCount(['kamar as kamar_tersedia' => fn($q) => $q->where('status_kamar', 'tersedia')])
            ->latest()->take(3)->get();

        return compact('pemilik', 'user', 'totalKos', 'totalKamar', 'kamarTerisi', 'totalKontrak', 'ratingKos', 'recentKos');
    }

    public function updatePemilik(int $userId, array $data): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $pemilik = $user->pemilik;

        if (!empty($data['username']) && $data['username'] !== $user->username) {
            $user->update(['username' => $data['username']]);
        }

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        unset($data['username'], $data['password'], $data['password_confirmation']);

        $pemilik->update($data);

        return compact('pemilik', 'user');
    }

    public function uploadPhotoPemilik(int $userId, $file): array
    {
        $user = \App\Models\User::findOrFail($userId);
        $pemilik = $user->pemilik;

        if ($pemilik->foto_profil && Storage::exists('public/' . $pemilik->foto_profil)) {
            Storage::delete('public/' . $pemilik->foto_profil);
        }

        $path = $file->store('profiles', 'public');
        $pemilik->update(['foto_profil' => $path]);

        return ['url' => Storage::url($path)];
    }

    public function changePassword(int $userId, string $passwordLama, string $passwordBaru): void
    {
        $user = User::findOrFail($userId);

        if (!Hash::check($passwordLama, $user->password)) {
            throw new \InvalidArgumentException('Password lama salah.');
        }

        $user->update(['password' => Hash::make($passwordBaru)]);
    }
}
