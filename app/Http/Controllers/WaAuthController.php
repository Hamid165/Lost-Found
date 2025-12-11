<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WaAuthController extends Controller
{
    public function connect(Request $request)
    {
        // 1. Ambil nomor HP dari parameter URL
        $phone = $request->query('phone');

        // Validasi: Jika link tidak membawa nomor HP, lempar ke beranda
        if (!$phone) {
            return redirect()->route('items.index')->with('error', 'Link tidak valid atau nomor tidak ditemukan.');
        }

        // 2. Ambil User yang sedang Login
        /** @var User $user */
        $user = Auth::user();

        // 3. Simpan Nomor WA ke Database User
        $user->no_telp = $phone;
        $user->save();

        // 4. Redirect Balik ke WhatsApp
        // GANTI NOMOR INI dengan Nomor WA Admin/Bot kamu (format 628...)
        $botNumber = '6281229404736';

        // Pesan otomatis yang akan muncul di ketikan user saat balik ke WA
        $text = urlencode("Saya sudah login");

        // Redirect membuka aplikasi WA
        return redirect("https://wa.me/{$botNumber}?text={$text}");
    }
}