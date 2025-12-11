<?php

use App\Http\Middleware\CspMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // --- KODE LAMA ANDA (Biarkan saja) ---
        $middleware->web(append: [
            CspMiddleware::class,
        ]);

        // --- TAMBAHAN BARU (Tempel di sini) ---
        // Ini berfungsi agar URL webhook tidak diblokir oleh Laravel
        $middleware->validateCsrfTokens(except: [
            'webhook/whatsapp',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();