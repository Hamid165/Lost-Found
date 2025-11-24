<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // PERBAIKAN PHPSTAN LEVEL 9:
        // 1. Ambil user ke variabel
        $user = $request->user();

        // 2. Safety Check: Pastikan user tidak null sebelum update
        if ($user === null) {
            return redirect()->route('login');
        }

        // 3. Update password
        // Tips: Gunakan $request->string(...)->toString() agar Hash::make tidak komplain soal tipe data 'mixed'
        $user->update([
            'password' => Hash::make($request->string('password')->toString()),
        ]);

        return back()->with('status', 'password-updated');
    }
}