<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:penghuni,pemilik,admin'
        ]);

        $credentials = $request->only('username', 'password', 'role');
        $role = $request->role;
        $remember = $request->has('remember');

        // Attempt login with correct guard based on role
        if (Auth::guard($role)->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect based on role
            if ($role === 'penghuni') {
                return redirect()->route('penghuni.dashboard')
                    ->with('success', 'Login sebagai penghuni berhasil!');
            } elseif ($role === 'pemilik') {
                return redirect()->route('pemilik.dashboard')
                    ->with('success', 'Login sebagai pemilik berhasil!');
            } else {
                return redirect('/')->with('success', 'Login sebagai admin berhasil!');
            }
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput($request->only('username', 'role'));
    }

    public function logout(Request $request)
    {
        $role = null;
        foreach (['penghuni', 'pemilik', 'web'] as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::guard($guard)->user()->role ?? 'User';
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', "Logout " . ($role ?? 'User') . " berhasil! Sampai jumpa kembali.");
    }
}