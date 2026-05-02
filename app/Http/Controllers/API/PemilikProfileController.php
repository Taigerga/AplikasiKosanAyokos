<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PemilikProfileController extends Controller
{
    public function show()
    {
        $pemilik = Auth::user();
        return response()->json(['success' => true, 'data' => $pemilik]);
    }

    public function edit()
    {
        $pemilik = Auth::user();
        return response()->json(['success' => true, 'data' => $pemilik]);
    }

    public function update(Request $request)
    {
        $pemilik = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'sometimes|email|max:100|unique:pemilik,email,' . $pemilik->id_pemilik . ',id_pemilik',
            'jenis_kelamin' => 'sometimes|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'nama_bank' => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $pemilik->update($request->only([
            'nama', 'no_hp', 'email', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'nama_bank', 'nomor_rekening'
        ]));

        return response()->json([
            'success' => true,
            'data' => $pemilik,
            'message' => 'Profile updated successfully'
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $pemilik = Auth::user();

        $request->validate([
            'foto_profil' => 'required|string|max:255'
        ]);

        $pemilik->update(['foto_profil' => $request->foto_profil]);

        return response()->json([
            'success' => true,
            'data' => $pemilik,
            'message' => 'Photo uploaded successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        $pemilik = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        if (!Hash::check($request->current_password, $pemilik->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $pemilik->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    }
}
