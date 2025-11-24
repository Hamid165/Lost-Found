<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail; // <-- 1. Import Interface ini
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user === null) {
            return redirect()->route('login');
        }

        // PERBAIKAN PHPSTAN LEVEL 9:
        // Cek apakah $user mengimplementasikan MustVerifyEmail menggunakan instanceof.
        // Ini menjamin tipe data aman untuk event Verified().

        // Cek 1: Jika bukan instance MustVerifyEmail, anggap saja tidak perlu verifikasi (atau throw error, tergantung kebutuhan)
        if (! $user instanceof MustVerifyEmail) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Mulai dari sini, PHPStan tahu $user adalah kombinasi (User & MustVerifyEmail)

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}