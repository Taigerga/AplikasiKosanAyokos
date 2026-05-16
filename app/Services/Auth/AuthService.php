<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Penghuni;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthService
{
    public function login(array $credentials, bool $remember = false): array
    {
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            request()->session()->regenerate();
            $user = Auth::guard('web')->user();
            Auth::guard($user->role)->login($user);

            return [
                'success' => true,
                'user' => $user,
                'redirect' => match ($user->role) {
                    'penghuni' => route('penghuni.dashboard'),
                    'pemilik' => route('pemilik.dashboard'),
                    default => '/',
                },
            ];
        }

        return ['success' => false, 'message' => 'Username atau password salah.'];
    }

    public function logout(): void
    {
        $user = Auth::guard('web')->user();
        $role = $user->role ?? null;

        if ($role) {
            Auth::guard($role)->logout();
        }
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function register(array $data): array
    {
        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $fotoProfilPath = null;
        if (!empty($data['foto_profil'])) {
            $fotoProfilPath = $data['foto_profil']->store('profiles', 'public');
        }

        if ($data['role'] === 'penghuni') {
            Penghuni::create([
                'user_id' => $user->id,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat' => $data['alamat'],
                'foto_profil' => $fotoProfilPath,
                'status_penghuni' => 'calon',
            ]);
        } else {
            Pemilik::create([
                'user_id' => $user->id,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat' => $data['alamat'],
                'foto_profil' => $fotoProfilPath,
                'status_pemilik' => 'pending',
            ]);
        }

        Auth::login($user);

        return [
            'success' => true,
            'user' => $user,
            'redirect' => $data['role'] === 'penghuni'
                ? route('penghuni.dashboard')
                : route('pemilik.dashboard'),
        ];
    }

    public static function validationRules(string $role): array
    {
        return [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'alamat' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|max:2048',
        ];
    }
}
