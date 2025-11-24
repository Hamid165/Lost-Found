<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        // PERBAIKAN PHPSTAN LEVEL 9:
        // 1. Ambil user ke variabel dulu
        $user = $request->user();

        // 2. Cek apakah user null (safety check)
        // Jika null (misal session habis), lempar ke halaman login
        if ($user === null) {
            return redirect()->route('login');
        }

        // 3. Sekarang PHPStan tahu $user pasti object User (bukan null)
        if (! Auth::guard('web')->validate([
            'email' => $user->email, // Aman diakses
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}