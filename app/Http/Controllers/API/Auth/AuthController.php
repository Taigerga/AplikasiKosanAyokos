<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\PasswordResetMail;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            return $this->error('Email tidak ditemukan untuk akun ini.', 404);
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($email)->send(new PasswordResetMail($token, $nama, $email));

        return $this->success(null, 'Link reset password telah dikirim ke email Anda.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return $this->error('Token reset password tidak valid atau sudah kadaluarsa.', 400);
        }

        if ($record->created_at < now()->subMinutes(60)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return $this->error('Token reset password sudah kadaluarsa. Silakan minta ulang.', 400);
        }

        $user = User::whereHas('penghuni', fn($q) => $q->where('email', $request->email))
            ->orWhereHas('pemilik', fn($q) => $q->where('email', $request->email))
            ->orWhereHas('admin', fn($q) => $q->where('email', $request->email))
            ->first();

        if (!$user) {
            return $this->error('Pengguna tidak ditemukan.', 404);
        }

        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return $this->success(null, 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
