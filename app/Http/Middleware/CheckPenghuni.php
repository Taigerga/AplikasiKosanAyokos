<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPenghuni
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'penghuni') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai penghuni.');
        }

        $user = Auth::user();

        if ($user->isDiblokir()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error', 'Akun Anda telah diblokir. Silakan hubungi admin.');
        }

        if ($user->isDibatasi()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error', 'Akun Anda sedang dibatasi. Silakan hubungi admin.');
        }

        return $next($request);
    }
}