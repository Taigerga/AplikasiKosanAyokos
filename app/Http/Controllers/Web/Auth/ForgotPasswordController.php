<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.exists' => 'Username tidak ditemukan.',
        ]);

        $user = User::where('username', $request->username)->first();

        $email = null;
        $nama = $user->username;

        if ($user->role === 'penghuni' && $user->penghuni) {
            $email = $user->penghuni->email;
            $nama = $user->penghuni->nama;
        } elseif ($user->role === 'pemilik' && $user->pemilik) {
            $email = $user->pemilik->email;
            $nama = $user->pemilik->nama;
        } elseif ($user->role === 'admin' && $user->admin) {
            $email = $user->admin->email;
            $nama = $user->admin->nama;
        }

        if (!$email) {
            return back()->withErrors(['username' => 'Email tidak ditemukan untuk akun ini.'])->withInput();
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($email)->send(new PasswordResetMail($token, $nama, $email));

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }
}
