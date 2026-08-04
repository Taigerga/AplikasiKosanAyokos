<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(self), camera=(), microphone=(), payment=()');

        if ($request->isSecure() || app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        $isLocal = app()->environment('local');
        $viteUrls = $isLocal ? ['http://localhost:5173', 'http://127.0.0.1:5173'] : [];

        $scriptSrc = ["'self'", "'unsafe-inline'", 'https://unpkg.com', 'https://cdn.jsdelivr.net', 'https://cdnjs.cloudflare.com', 'https://html2canvas.hertzen.com'];
        $styleSrc  = ["'self'", "'unsafe-inline'", 'https://fonts.googleapis.com', 'https://unpkg.com', 'https://cdnjs.cloudflare.com'];
        $imgSrc    = ["'self'", 'data:', 'https://images.unsplash.com', 'https://raw.githubusercontent.com', 'https://cdnjs.cloudflare.com', 'https://*.basemaps.cartocdn.com', 'https://*.tile.openstreetmap.org'];
        $fontSrc   = ["'self'", 'data:', 'https://fonts.gstatic.com', 'https://cdnjs.cloudflare.com'];
        $connectSrc = ["'self'", 'https://nominatim.openstreetmap.org', 'https://overpass-api.de', 'https://*.basemaps.cartocdn.com', 'https://*.tile.openstreetmap.org', 'https://router.project-osrm.org'];
        $frameSrc  = ["'self'", 'https://app.sandbox.midtrans.com', 'https://app.midtrans.com'];
        $mediaSrc  = ["'self'"];

        foreach ($viteUrls as $url) {
            $scriptSrc[] = $url;
            $styleSrc[] = $url;
            $fontSrc[] = $url;
            $imgSrc[] = $url;
            $wsUrl = str_replace('http://', 'ws://', $url);
            $connectSrc[] = $url;
            $connectSrc[] = $wsUrl;
        }

        $csp = 'default-src \'self\'; '
             . 'script-src ' . implode(' ', $scriptSrc) . '; '
             . 'style-src ' . implode(' ', $styleSrc) . '; '
             . 'img-src ' . implode(' ', $imgSrc) . '; '
             . 'font-src ' . implode(' ', $fontSrc) . '; '
             . 'connect-src ' . implode(' ', $connectSrc) . '; '
             . 'frame-src ' . implode(' ', $frameSrc) . '; '
             . 'media-src ' . implode(' ', $mediaSrc) . '; '
             . 'form-action \'self\'';

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
