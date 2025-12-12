<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahan untuk Cek Log
use App\Models\User;

class WaAuthController extends Controller
{
    public function connect(Request $request)
    {
        // 1. Ambil nomor HP dari parameter URL
        $phone = $request->query('phone');

        // --- DEBUGGING AREA (Hapus tanda // di bawah ini jika ingin tes layar hitam) ---
        // dd("CONTROLLER JALAN!", "User: " . Auth::user()->name, "Phone: " . $phone);
        // -----------------------------------------------------------------------------

        // Log Sistem: Mencatat bahwa ada user yang mencoba akses link ini
        if (Auth::check()) {
            Log::info("User " . Auth::user()->name . " mencoba mengaitkan WA. No HP di Link: " . $phone);
        } else {
            Log::warning("Ada akses ke Link WA tapi User belum Login/Auth bermasalah.");
        }

        // Validasi: Jika link tidak membawa nomor HP
        if (!$phone) {
            return redirect()->route('items.index')->with('error', 'Link tidak valid atau nomor tidak ditemukan.');
        }

        // 2. Ambil User yang sedang Login
        /** @var User $user */
        $user = Auth::user();

        // Cek apakah user benar-benar ada (Safety Check)
        if ($user) {
            // 3. Simpan Nomor WA ke Database User
            // Kita pakai forceFill agar tidak terhalang $fillable (Opsional, tapi aman)
            $user->forceFill([
                'no_telp' => $phone
            ])->save();

            Log::info("SUKSES: Nomor $phone berhasil disimpan ke user " . $user->name);
        } else {
            // Harusnya tidak mungkin masuk sini karena ada middleware auth, tapi jaga-jaga
            return redirect('/login')->with('error', 'Sesi habis, silakan login ulang.');
        }

        // 4. Redirect Balik ke WhatsApp
        // Nomor Bot Anda
        $botNumber = '6281229404736';

        // Pesan otomatis yang akan muncul di ketikan user saat balik ke WA
        $text = urlencode("Saya sudah login");

        // Redirect membuka aplikasi WA
        return redirect("https://wa.me/{$botNumber}?text={$text}");
    }
}