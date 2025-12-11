<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WhatsappWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1. TANGKAP DATA DARI FONNTE
        $message = trim($request->input('message')); // Isi pesan
        $sender = $request->input('sender');         // Nomor HP Pengirim

        // Log untuk debugging (bisa dicek di storage/logs/laravel.log)
        Log::info("WA Masuk [$sender]: $message");

        // 2. CEK USER DI DATABASE
        // Pastikan kolom di tabel users kamu namanya 'no_telp' atau sesuaikan dengan 'phone'
        $user = User::where('no_telp', $sender)->first();

        // --- SKENARIO 1: USER BELUM TERDAFTAR ---
        // --- SKENARIO 1: USER BELUM TERDAFTAR ---
        if (!$user) {
            return $this->balasPesan(
                $sender,
                "Halo! Nomor WhatsApp Anda belum terdaftar di sistem kami.\n\n" .
                    "Mohon Login atau Registrasi terlebih dahulu lewat link ini:\n" .
                    route('login.from.wa') . "\n\n" . // <--- GANTI JADI INI
                    "👉 *PENTING:* Gunakan Nomor HP yang SAMA dengan WhatsApp ini.\n\n" .
                    "Jika sudah berhasil login, kembali ke sini dan ketik:\n" .
                    "*Saya sudah login*"
            );
        }

        // --- SKENARIO 2: USER SUDAH TERDAFTAR (ATAU BARU BALIK DARI WEB) ---

        // Ambil sesi chat terakhir dari Cache
        $cacheKey = 'wa_session_' . $sender;
        $session = Cache::get($cacheKey, ['step' => 'idle', 'data' => []]);
        $step = $session['step'];

        // FITUR RESET / MENU UTAMA / TRIGGER SETELAH LOGIN
        // Kata kunci ini akan mereset percakapan ke awal
        $triggerWords = ['menu', 'lapor', 'batal', 'saya sudah login', 'halo admin', 'hi', 'tes'];

        if (in_array(strtolower($message), $triggerWords)) {
            $this->updateSession($sender, 'pilih_kategori', []);

            return $this->balasPesan(
                $sender,
                "Halo {$user->name}! 👋\nStatus: Terhubung ✅\n\n" .
                    "Silakan pilih jenis laporan:\n" .
                    "1️⃣ Kehilangan Barang\n" .
                    "2️⃣ Penemuan Barang\n\n" .
                    "Ketik *1* atau *2*."
            );
        }

        // 3. LOGIKA FLOWCHART (STATE MACHINE)
        switch ($step) {

            // --- TAHAP 1: PILIH KATEGORI ---
            case 'pilih_kategori':
                if ($message == '1') {
                    $this->updateSession($sender, 'tanya_barang', ['tipe' => 'lost']);
                    return $this->balasPesan($sender, "Oke, Lapor *KEHILANGAN*.\n\n1. Apa nama barangnya? (Contoh: Dompet, Laptop)");
                } elseif ($message == '2') {
                    $this->updateSession($sender, 'tanya_barang', ['tipe' => 'found']);
                    return $this->balasPesan($sender, "Oke, Lapor *PENEMUAN*.\n\n1. Apa nama barangnya? (Contoh: Kunci Motor)");
                } else {
                    return $this->balasPesan($sender, "🚫 Pilihan salah. Ketik *1* untuk Kehilangan atau *2* untuk Penemuan.");
                }

                // --- TAHAP 2: NAMA BARANG ---
            case 'tanya_barang':
                if (strlen($message) < 3) {
                    return $this->balasPesan($sender, "🚫 Nama barang terlalu pendek. Mohon isi dengan jelas.");
                }
                $this->simpanDataSementara($sender, 'nama_barang', $message, 'tanya_lokasi');
                return $this->balasPesan($sender, "2. Di mana lokasi kejadian/penemuan? (Contoh: Kantin Teknik)");

                // --- TAHAP 3: LOKASI ---
            case 'tanya_lokasi':
                $this->simpanDataSementara($sender, 'lokasi', $message, 'tanya_tanggal');
                return $this->balasPesan($sender, "3. Kapan tanggal kejadian? (Format: YYYY-MM-DD)\nContoh: " . date('Y-m-d'));

                // --- TAHAP 4: TANGGAL (Validasi Format) ---
            case 'tanya_tanggal':
                // Regex untuk cek format YYYY-MM-DD
                if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $message)) {
                    return $this->balasPesan($sender, "🚫 Format tanggal salah!\nGunakan format Tahun-Bulan-Tanggal.\nContoh: *2024-12-31*");
                }
                $this->simpanDataSementara($sender, 'tanggal', $message, 'tanya_status_pelapor');

                return $this->balasPesan(
                    $sender,
                    "4. Apa status Anda di kampus?\n\n" .
                        "A. Mahasiswa\n" .
                        "B. Dosen\n" .
                        "C. Lainnya\n\n" .
                        "Ketik *A*, *B*, atau *C*."
                );

                // --- TAHAP 5: STATUS PELAPOR ---
            case 'tanya_status_pelapor':
                $pilihan = strtoupper($message);
                if ($pilihan == 'A') {
                    $this->simpanDataSementara($sender, 'status_pelapor', 'Mahasiswa', 'tanya_identitas');
                    return $this->balasPesan($sender, "5. Masukkan NIM Anda:");
                } elseif ($pilihan == 'B') {
                    $this->simpanDataSementara($sender, 'status_pelapor', 'Dosen', 'tanya_identitas');
                    return $this->balasPesan($sender, "5. Masukkan NIP Anda:");
                } elseif ($pilihan == 'C') {
                    $this->updateSession($sender, 'tanya_status_custom', $session['data']);
                    return $this->balasPesan($sender, "Silakan ketik status Anda (Misal: Satpam, Staff, Tamu):");
                } else {
                    return $this->balasPesan($sender, "🚫 Pilihan tidak tersedia. Ketik *A*, *B*, atau *C*.");
                }

                // --- TAHAP 5B: STATUS CUSTOM ---
            case 'tanya_status_custom':
                $this->simpanDataSementara($sender, 'status_pelapor', $message, 'tanya_identitas');
                return $this->balasPesan($sender, "5. Masukkan Nomor Identitas (KTP/NIP/NIM):");

                // --- TAHAP 6: IDENTITAS ---
            case 'tanya_identitas':
                $this->simpanDataSementara($sender, 'nim_nip', $message, 'tanya_deskripsi');
                return $this->balasPesan($sender, "6. Terakhir, berikan deskripsi/ciri-ciri detail barang tersebut:");

                // --- TAHAP 7: FINALISASI & SIMPAN KE DB ---
            case 'tanya_deskripsi':
                $data = $session['data'];
                $tipe = $data['tipe'];

                // Simpan ke Tabel yang Sesuai
                if ($tipe == 'lost') {
                    $item = LostItem::create([
                        'nama_barang'        => $data['nama_barang'],
                        'lokasi_terakhir'    => $data['lokasi'],
                        'tanggal_kehilangan' => $data['tanggal'],
                        'deskripsi'          => $message, // Pesan terakhir adalah deskripsi
                        'nama_pelapor'       => $user->name,
                        'no_telp'            => $sender,
                        'status_pelapor'     => $data['status_pelapor'],
                        'NIM_NIP'            => $data['nim_nip'],
                        'status'             => 'Masih Hilang',
                    ]);
                    $pesanSukses = "Laporan Kehilangan berhasil dicatat! ID: #L-{$item->id}";
                } else {
                    $item = FoundItem::create([
                        'nama_barang'      => $data['nama_barang'],
                        'lokasi_penemuan'  => $data['lokasi'],
                        'tanggal_penemuan' => $data['tanggal'],
                        'deskripsi'        => $message,
                        'nama_pelapor'     => $user->name,
                        'no_telp'          => $sender,
                        'status_pelapor'   => $data['status_pelapor'],
                        'NIM_NIP'          => $data['nim_nip'],
                        'status'           => 'Belum Diambil',
                    ]);
                    $pesanSukses = "Laporan Penemuan berhasil dicatat! ID: #F-{$item->id}";
                }

                // Hapus Sesi Chat agar bisa lapor baru lagi
                Cache::forget($cacheKey);

                return $this->balasPesan($sender, "✅ Terima kasih!\n$pesanSukses\n\nAdmin akan segera memverifikasi laporan ini.");

            default:
                // Jika user mengetik sesuatu di luar konteks
                $this->updateSession($sender, 'pilih_kategori', []);
                return $this->balasPesan($sender, "Halo! Ketik *Menu* untuk memulai laporan.");
        }
    }

    // --- HELPER FUNCTIONS ---

    // Fungsi untuk membalas pesan via JSON (Passive Reply Fonnte)
    private function balasPesan($target, $pesan)
    {
        return response()->json([
            'data' => [
                [
                    'url' => $target,
                    'message' => $pesan
                ]
            ]
        ]);
    }

    // Fungsi update sesi (langsung ganti step)
    private function updateSession($sender, $nextStep, $data)
    {
        Cache::put('wa_session_' . $sender, ['step' => $nextStep, 'data' => $data], 600); // Expire 10 menit
    }

    // Fungsi simpan data per pertanyaan (mengumpulkan data)
    private function simpanDataSementara($sender, $key, $value, $nextStep)
    {
        $cacheKey = 'wa_session_' . $sender;
        $session = Cache::get($cacheKey);

        // Simpan input user ke array data
        $session['data'][$key] = $value;
        // Pindah ke langkah berikutnya
        $session['step'] = $nextStep;

        Cache::put($cacheKey, $session, 600);
    }
}