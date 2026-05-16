<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login(
            $request->validated(),
            $request->has('remember')
        );

        if ($result['success']) {
            return redirect($result['redirect'])
                ->with('success', 'Login sebagai ' . $result['user']->role . ' berhasil!');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        return redirect('/')->with('success', 'Logout berhasil! Sampai jumpa kembali.');
    }
}
