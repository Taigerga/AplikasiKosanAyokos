<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenghuniProfileController extends Controller
{
    public function show()
    {
        $penghuni = Auth::user();
        return response()->json(['success' => true, 'data' => $penghuni]);
    }

    public function edit()
    {
        $penghuni = Auth::user();
        return response()->json(['success' => true, 'data' => $penghuni]);
    }

    public function update(Request $request)
    {
        $penghuni = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'sometimes|email|max:100|unique:penghuni,email,' . $penghuni->id_penghuni . ',id_penghuni',
            'jenis_kelamin' => 'sometimes|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $penghuni->update($request->only([
            'nama', 'no_hp', 'email', 'jenis_kelamin', 'tanggal_lahir', 'alamat'
        ]));

        return response()->json([
            'success' => true,
            'data' => $penghuni,
            'message' => 'Profile updated successfully'
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $penghuni = Auth::user();

        $request->validate([
            'foto_profil' => 'required|string|max:255'
        ]);

        $penghuni->update(['foto_profil' => $request->foto_profil]);

        return response()->json([
            'success' => true,
            'data' => $penghuni,
            'message' => 'Photo uploaded successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        $penghuni = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        if (!Hash::check($request->current_password, $penghuni->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $penghuni->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    }
}
