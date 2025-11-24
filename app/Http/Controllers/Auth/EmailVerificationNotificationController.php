<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // PERBAIKAN PHPSTAN LEVEL 9:
        // 1. Ambil user ke variabel
        $user = $request->user();

        // 2. Cek null (Safety Check)
        if ($user === null) {
            return redirect()->route('login');
        }

        // 3. Sekarang aman panggil method karena $user pasti object
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}