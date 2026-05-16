<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class RegisterController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->register($request->validated());

            return redirect($result['redirect'])
                ->with('success', 'Registrasi ' . $result['user']->role . ' berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'register' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage(),
            ])->withInput();
        }
    }
}
