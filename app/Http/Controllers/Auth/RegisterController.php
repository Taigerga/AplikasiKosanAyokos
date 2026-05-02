<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Penghuni;
use App\Models\Pemilik;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:penghuni,pemilik',
            'tanggal_lahir' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'alamat' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|max:2048'
        ];

        $messages = [
            'tanggal_lahir.before_or_equal' => 'Umur tidak boleh kurang dari 17 tahun.',
            'username.unique' => 'Username sudah digunakan.',
        ];

        $request->validate($rules, $messages);

        try {
            // Create user in users table
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            $fotoProfilPath = null;
            if ($request->hasFile('foto_profil')) {
                $fotoProfilPath = $request->file('foto_profil')->store('profiles', 'public');
            }

            // Create related record based on role
            if ($request->role === 'penghuni') {
                $penghuni = Penghuni::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                    'foto_profil' => $fotoProfilPath,
                    'status_penghuni' => 'calon',
                ]);

                Auth::login($user);
                return redirect()->route('penghuni.dashboard')
                    ->with('success', 'Registrasi penghuni berhasil!');

            } else {
                $pemilik = Pemilik::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                    'foto_profil' => $fotoProfilPath,
                    'status_pemilik' => 'pending',
                ]);

                Auth::login($user);
                return redirect()->route('pemilik.dashboard')
                    ->with('success', 'Registrasi pemilik berhasil!');
            }
        } catch (\Exception $e) {
            return back()->withErrors([
                'register' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage(),
            ])->withInput();
        }
    }
}