<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // PERBAIKAN PHPSTAN LEVEL 9:
        $user = $request->user();

        // 1. Safety check: Jika user null, redirect ke login
        if ($user === null) {
            return redirect()->route('login');
        }

        // 2. Sekarang aman panggil method karena $user pasti object
        return $user->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('auth.verify-email');
    }
}