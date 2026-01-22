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
        View::share('csp_nonce', $nonce);
        Vite::useCspNonce($nonce);

        // 2. Lanjutkan request
        $response = $next($request);

        // ====================================================================
        // PERBAIKAN 1: HAPUS & TAMBAH HEADER (Sesuai Laporan ZAP)
        // ====================================================================
        
        // Menghapus header yang membocorkan versi PHP (Risk: Lemah - Info Leak)
        $response->headers->remove('X-Powered-By');

        // Mencegah browser menebak tipe file (Risk: Lemah - MIME Sniffing)
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Mencegah Clickjacking (Sudah ada di kode lama, tapi kita pastikan)
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // Mengatur privasi referrer
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');


        // ====================================================================
        // PERBAIKAN 2: DEFINISI CSP YANG LEBIH RAPI & LENGKAP
        // ====================================================================
        
        $viteDev = 'http://localhost:5173 http://127.0.0.1:5173 ws://localhost:5173 ws://127.0.0.1:5173';

        // 1. Script Src: Digabung jadi satu agar tidak saling menimpa
        // Kita izinkan tailwindcss dan jsdelivr
        $scriptSrc = "'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net https://cdn.tailwindcss.com 'unsafe-eval'";

        // 2. Style Src
        $styleSrc = "'self' https://fonts.bunny.net 'unsafe-inline'";

        // 3. Font & Image Src
        $fontSrc = "'self' https://fonts.bunny.net";
        $imgSrc = "'self' data: https://ui-avatars.com";
        
        // 4. Connect Src
        $connectSrc = "'self' https://cdn.jsdelivr.net";

        // Jika LOCAL, tambahkan akses ke Vite
        if (App::isLocal()) {
            $scriptSrc .= " {$viteDev} 'unsafe-inline'";
            $styleSrc .= " {$viteDev}";
            $connectSrc .= " {$viteDev}";
            $imgSrc .= " {$viteDev}";
        }

        // Susun Kebijakan (Policy)
        // Menambahkan object-src dan base-uri untuk menutup temuan "No Fallback" ZAP
        $policy  = "default-src 'self';";
        $policy .= "base-uri 'self';";
        $policy .= "object-src 'none';"; 
        $policy .= "script-src {$scriptSrc};";
        $policy .= "style-src {$styleSrc};";
        $policy .= "font-src {$fontSrc};";
        $policy .= "img-src {$imgSrc};";
        $policy .= "connect-src {$connectSrc};";

        // Set Header CSP
        $response->headers->set('Content-Security-Policy', $policy);

        // ====================================================================
        // PERBAIKAN 3: HSTS (Strict Transport Security)
        // ====================================================================
        // Memaksa HTTPS di Production (Risk: Lemah - HSTS Not Set)
        if (App::isProduction()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}