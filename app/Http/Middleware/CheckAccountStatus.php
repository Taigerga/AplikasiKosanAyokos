<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        if ($user->role === 'admin') {
            return $next($request);
        }

        if ($user->isDiblokir()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda telah diblokir. Silakan hubungi admin.',
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Akun Anda telah diblokir. Silakan hubungi admin.');
        }

        if ($user->isDibatasi()) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda sedang dibatasi. Silakan hubungi admin.',
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Akun Anda sedang dibatasi. Silakan hubungi admin.');
        }

        return $next($request);
    }
}
