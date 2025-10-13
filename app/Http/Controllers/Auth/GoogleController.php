<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    /**
     * Mengarahkan pengguna ke halaman autentikasi Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Menangani callback dari Google setelah autentikasi.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan google_id, atau buat baru jika tidak ada.
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
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
