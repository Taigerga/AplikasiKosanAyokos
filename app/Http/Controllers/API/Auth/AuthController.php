<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->login(
                $request->validated(),
                $request->has('remember')
            );

            if (!$result['success']) {
                return $this->error($result['message'], 401);
            }

            $user = Auth::guard('web')->user();
            $token = $user?->createToken('api-token')->plainTextToken;

            session()->flash('success', 'Login sebagai ' . $result['user']->role . ' berhasil!');

            return $this->success([
                'user' => $result['user']->loadMissing($result['user']->role),
                'token' => $token,
                'redirect' => $result['redirect'],
            ], 'Login berhasil');
        } catch (\Exception $e) {
            return $this->error('Terjadi kesalahan saat login. Silakan coba lagi.', 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            if ($user) {
                $user->currentAccessToken()?->delete();
                $this->authService->logout();
            }
            return $this->success(null, 'Logout berhasil');
        } catch (\Exception $e) {
            return $this->success(null, 'Logout berhasil');
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return $this->unauthorized('Sesi tidak ditemukan.');
            }
            $user->loadMissing($user->role);
            return $this->success($user);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat data pengguna.', 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->register($request->validated());
            $token = $result['user']->createToken('api-token')->plainTextToken;

            session()->flash('success', 'Registrasi ' . $result['user']->role . ' berhasil!');

            return $this->created([
                'user' => $result['user']->loadMissing($result['user']->role),
                'token' => $token,
                'redirect' => $result['redirect'],
            ], 'Registrasi ' . $result['user']->role . ' berhasil');
        } catch (\Exception $e) {
            return $this->error('Registrasi gagal. Silakan coba lagi.', 500);
        }
    }

    public function registerPenghuni(RegisterRequest $request)
    {
        $request->merge(['role' => 'penghuni']);
        return $this->register($request);
    }

    public function registerPemilik(RegisterRequest $request)
    {
        $request->merge(['role' => 'pemilik']);
        return $this->register($request);
    }
}
