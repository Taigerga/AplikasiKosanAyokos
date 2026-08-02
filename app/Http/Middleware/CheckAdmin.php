<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('sanctum') ?? $request->user();

        if (!$user || $user->role !== 'admin') {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login sebagai admin.',
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin.');
        }

        return $next($request);
    }
}
