<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse; // Import untuk return type

class GoogleController extends Controller
{
    /**
     * Mengarahkan pengguna ke halaman autentikasi Google.
     */
    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Menangani callback dari Google setelah autentikasi.
     */
    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // PERBAIKAN: Gunakan Getter Method, bukan Property Magic
            // $googleUser->id   -> $googleUser->getId()
            // $googleUser->name -> $googleUser->getName()
            // $googleUser->email -> $googleUser->getEmail()

            // Cari pengguna berdasarkan google_id, atau buat baru jika tidak ada.
            $user = User::updateOrCreate([
                'google_id' => $googleUser->getId(),
            ], [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ]);

            // Login-kan pengguna ke sistem kita.
            Auth::login($user);

            // Redirect ke halaman utama setelah login berhasil.
            return redirect('/');
        } catch (\Exception $e) {
            // Jika ada error, kembalikan ke halaman login.
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}