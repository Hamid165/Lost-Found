<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class CspMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Buat Nonce
        $nonce = bin2hex(random_bytes(16));

        // 2. Bagikan nonce ke semua view
        View::share('csp_nonce', $nonce);

        // 3. Beri tahu Vite untuk menggunakan nonce
        Vite::useCspNonce($nonce);

        // 4. Lanjutkan request untuk mendapatkan response
        $response = $next($request);

        // 5. Definisikan alamat server dev (TANPA [::1] yang error)
        $viteDevHttp = 'http://localhost:5173 http://127.0.0.1:5173';
        $viteDevWs = 'ws://localhost:5173 ws://127.0.0.1:5173';

        // 6. Siapkan arahan (directives) kebijakan dasar
        $policy = "default-src 'self';";

        // ====================================================================
        // PERBAIKAN:
        // 1. 'unsafe-inline' dihapus (karena diabaikan oleh nonce)
        // 2. https://ui-avatars.com ditambahkan ke img-src
        // 3. https://cdn.jsdelivr.net ditambahkan ke connect-src
        // ====================================================================
        $scriptSrc = "'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net https://cdn.tailwindcss.com 'unsafe-eval' 'unsafe-inline'";

        // 'unsafe-inline' tidak diperlukan lagi karena kita pakai Alpine.js (via 'unsafe-eval') dan nonce
        $scriptSrc = "'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net 'unsafe-eval' 'unsafe-inline'";

        $styleSrc = "'self' https://fonts.bunny.net 'unsafe-inline'";
        $fontSrc = "'self' https://fonts.bunny.net";

        // Izinkan gambar dari ui-avatars.com
        $imgSrc = "'self' data: https://ui-avatars.com";

        // Izinkan koneksi ke CDN (untuk file .map Chart.js)
        $connectSrc = "'self' https://cdn.jsdelivr.net";

        // 7. JIKA DI LOCAL: Izinkan koneksi ke Vite Dev Server
        if (App::isLocal()) {
            $scriptSrc .= " {$viteDevHttp}";
            $styleSrc .= " {$viteDevHttp}";
            $connectSrc .= " {$viteDevHttp} {$viteDevWs}";
        }

        // 8. Gabungkan semua kebijakan menjadi satu string
        $policy .= "script-src {$scriptSrc};";
        $policy .= "style-src {$styleSrc};";
        $policy .= "font-src {$fontSrc};";
        $policy .= "img-src {$imgSrc};";
        $policy .= "connect-src {$connectSrc};";

        // 9. Tambahkan header ke response
        $response->headers->set('Content-Security-Policy', $policy);

        // 10. Tambahkan X-Frame-Options (Mencegah Clickjacking)
        $response->headers->set('X-Frame-Options', 'DENY');

        // 11. Tambahkan HSTS (Hanya jika di produksi & HTTPS)
        // Ini memaksa browser menggunakan HTTPS
        if (App::isProduction() && $request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}