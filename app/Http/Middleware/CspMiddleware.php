<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\App;

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
        $viteDevHttp = "http://localhost:5173 http://127.0.0.1:5173";
        $viteDevWs = "ws://localhost:5173 ws://127.0.0.1:5173";

        // 6. Siapkan arahan (directives) kebijakan dasar
        $policy = "default-src 'self';";

        // (Termasuk 'unsafe-eval' untuk Alpine.js)
        $scriptSrc = "'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net 'unsafe-eval'";

        $styleSrc = "'self' https://fonts.bunny.net 'unsafe-inline'";
        $fontSrc = "'self' https://fonts.bunny.net";
        $imgSrc = "'self' data:";
        $connectSrc = "'self'";

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
