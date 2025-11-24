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

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // PERBAIKAN: Ambil user dan cek null
        /** @var User|null $user */
        $user = $request->user();

        // Guard Clause: Jika user null (misal session habis), redirect ke login
        if ($user === null) {
            return Redirect::route('login');
        }

        // Sekarang PHPStan tahu $user pasti Object User, bukan null
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Logika untuk menangani unggahan foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Ambil file dengan aman
            $file = $request->file('profile_photo');

            if ($file) {
                $path = $file->store('profile-photos', 'public');
                // Pastikan path tidak false sebelum assign
                if ($path) {
                    $user->profile_photo_path = $path;
                }
            }
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /** @var User|null $user */
        $user = $request->user();

        // Guard Clause lagi untuk memastikan User ada
        if ($user === null) {
            return Redirect::route('login');
        }

        // PERBAIKAN: Cek dulu apakah user punya password
        if ($user->password) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
        }

        Auth::logout();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}