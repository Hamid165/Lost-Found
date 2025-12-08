<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User; // Import Model User
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * Controller ini menangani manajemen profil pengguna.
 * Termasuk menampilkan halaman edit profil, memperbarui informasi profil (termasuk foto),
 * dan menghapus akun pengguna.
 */
class ProfileController extends Controller
{
    /**
     * Menampilkan formulir profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * Object Request untuk mengambil user yang sedang login.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'profile.edit' dengan data user.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * Request khusus yang sudah tervalidasi otomatis.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect kembali ke halaman edit profil dengan status 'profile-updated'.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Ambil User Saat Ini
        /** @var User|null $user */
        $user = $request->user();

        // Guard Clause: Jika user null (misal session habis), redirect ke login
        if ($user === null) {
            return Redirect::route('login');
        }

        // 2. Isi Data User dengan Validated Input
        // $request->validated() hanya mengembalikan data yang lolos validasi ProfileUpdateRequest.
        $user->fill($request->validated());

        // 3. Reset Email Verification (Jika Email Berubah)
        // Jika kolom 'email' diubah (isDirty), kita set 'email_verified_at' jadi null
        // agar user memverifikasi ulang email barunya.
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 4. Logika Upload Foto Profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto profil lama dari storage jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Ambil file yang diupload
            $file = $request->file('profile_photo');

            if ($file) {
                // Simpan file ke direktori 'profile-photos' di disk 'public'
                // Method store() mengembalikan path file yang disimpan/
                $path = $file->store('profile-photos', 'public');
                
                // Simpan path file baru ke database
                if ($path) {
                    $user->profile_photo_path = $path;
                }
            }
        }

        // 5. Simpan Perubahan ke Database
        $user->save();

        // 6. Redirect
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna sepenuhnya.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect ke halaman utama (/) setelah akun dihapus.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Ambil User
        /** @var User|null $user */
        $user = $request->user();

        // Guard: Pastikan user ada
        if ($user === null) {
            return Redirect::route('login');
        }

        // 2. Validasi Password Terakhir (Konfirmasi Hapus)
        // Jika user memiliki password (bukan login via Google/Social), minta konfirmasi pass.
        if ($user->password) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
        }

        // 3. Logout User
        Auth::logout();

        // 4. Hapus Foto Profil dari Storage (Kebersihan Data)
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // 5. Hapus Akun dari Database
        $user->delete();

        // 6. Invalidate Session
        // Mematikan session agar tidak bisa dipakai lagi (keamanan).
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 7. Redirect ke Homepage
        return Redirect::to('/');
    }
}