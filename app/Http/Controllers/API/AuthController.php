<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        // Kita cari usernya dulu
        $user = User::where('username', $request->username)->first();

        // Cek apakah user ada dan passwordnya cocok
        if ($user && Hash::check($request->password, $user->password)) {
            
            // Cek apakah role sesuai (admin/pemilik/penghuni)
            if ($user->role !== $request->role) {
                return response()->json(['message' => 'Role tidak sesuai'], 403);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function registerPenghuni(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:penghuni,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $penghuni = Penghuni::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'status_penghuni' => 'calon'
        ]);

        $token = $penghuni->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $penghuni,
            'token' => $token,
            'role' => 'penghuni',
            'message' => 'Registration successful'
        ], 201);
    }

    public function registerPemilik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pemilik,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $pemilik = Pemilik::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'status_pemilik' => 'pending'
        ]);

        $token = $pemilik->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $pemilik,
            'token' => $token,
            'role' => 'pemilik',
            'message' => 'Registration successful'
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logged out successfully']);
    }

    public function me(Request $request)
    {
        return response()->json(['success' => true, 'user' => $request->user()]);
    }
}
