<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http; // <--- WAJIB ADA: Untuk kirim pesan balik

class WhatsappWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1. TANGKAP DATA DARI FONNTE
        $message = trim($request->input('message')); // Isi pesan
        $sender = $request->input('sender');         // Nomor HP Pengirim (Format 628...)

        // Log untuk debugging
        Log::info("WA Masuk [$sender]: $message");

        // 2. CEK USER DI DATABASE
        // Tips: Fonnte kirim 628..., tapi di DB mungkin 08...
        // Kita cari kedua kemungkinan format nomor
        $user = User::where('no_telp', $sender)
            ->orWhere('no_telp', '0' . substr($sender, 2)) // Ubah 62 jadi 0
            ->first();

        // --- SKENARIO 1: USER BELUM TERDAFTAR ---
        if (!$user) {
            $this->balasPesan(
                $sender,
                "Halo! Nomor WhatsApp Anda belum terdaftar di sistem kami.\n\n" .
                    "Mohon Login atau Registrasi terlebih dahulu lewat link ini:\n" .
                    route('login.from.wa') . "\n\n" .
                    "👉 *PENTING:* Gunakan Nomor HP yang SAMA dengan WhatsApp ini.\n" .
                    "Setelah login berhasil, silakan kembali ke sini dan ketik *Menu*."
            );
            return response('OK', 200); // Stop proses di sini
        }

        // --- SKENARIO 2: USER SUDAH TERDAFTAR ---

        // Ambil sesi chat terakhir dari Cache
        $cacheKey = 'wa_session_' . $sender;
        $session = Cache::get($cacheKey, ['step' => 'idle', 'data' => []]);
        $step = $session['step'];

        // FITUR RESET / MENU UTAMA / TRIGGER
        $triggerWords = ['menu', 'lapor', 'batal', 'saya sudah login', 'halo admin', 'hi', 'tes', 'halo', 'ping'];

        // Cek trigger (case insensitive)
        $isTrigger = false;
        foreach ($triggerWords as $word) {
            if (stripos(strtolower($message), $word) !== false) {
                $isTrigger = true;
                break;
            }
        }

        if ($isTrigger) {
            $this->updateSession($sender, 'pilih_kategori', []);

            $this->balasPesan(
                $sender,
                "Halo {$user->name}! 👋\nStatus: Terhubung ✅\n\n" .
                    "Silakan pilih jenis laporan:\n" .
                    "1️⃣ Kehilangan Barang\n" .
                    "2️⃣ Penemuan Barang\n\n" .
                    "Ketik *1* atau *2*."
            );
            return response('OK', 200);
        }

        // 3. LOGIKA FLOWCHART (STATE MACHINE)
        switch ($step) {

            // --- TAHAP 1: PILIH KATEGORI ---
            case 'pilih_kategori':
                if ($message == '1') {
                    $this->updateSession($sender, 'tanya_barang', ['tipe' => 'lost']);
                    $this->balasPesan($sender, "Oke, Lapor *KEHILANGAN*.\n\n1. Apa nama barangnya? (Contoh: Dompet, Laptop)");
                } elseif ($message == '2') {
                    $this->updateSession($sender, 'tanya_barang', ['tipe' => 'found']);
                    $this->balasPesan($sender, "Oke, Lapor *PENEMUAN*.\n\n1. Apa nama barangnya? (Contoh: Kunci Motor)");
                } else {
                    $this->balasPesan($sender, "🚫 Pilihan salah. Ketik *1* untuk Kehilangan atau *2* untuk Penemuan.");
                }
                break;

            // --- TAHAP 2: NAMA BARANG ---
            case 'tanya_barang':
                if (strlen($message) < 3) {
                    $this->balasPesan($sender, "🚫 Nama barang terlalu pendek. Mohon isi dengan jelas.");
                    break;
                }
                $this->simpanDataSementara($sender, 'nama_barang', $message, 'tanya_lokasi');
                $this->balasPesan($sender, "2. Di mana lokasi kejadian/penemuan? (Contoh: Kantin Teknik)");
                break;

            // --- TAHAP 3: LOKASI ---
            case 'tanya_lokasi':
                $this->simpanDataSementara($sender, 'lokasi', $message, 'tanya_tanggal');
                $this->balasPesan($sender, "3. Kapan tanggal kejadian? (Format: YYYY-MM-DD)\nContoh: " . date('Y-m-d'));
                break;

            // --- TAHAP 4: TANGGAL ---
            case 'tanya_tanggal':
                // Regex Validasi Tanggal YYYY-MM-DD
                if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $message)) {
                    $this->balasPesan($sender, "🚫 Format tanggal salah!\nGunakan format Tahun-Bulan-Tanggal.\nContoh: *2024-12-31*");
                    break;
                }
                $this->simpanDataSementara($sender, 'tanggal', $message, 'tanya_status_pelapor');
                $this->balasPesan(
                    $sender,
                    "4. Apa status Anda di kampus?\n\n" .
                        "A. Mahasiswa\n" .
                        "B. Dosen\n" .
                        "C. Lainnya\n\n" .
                        "Ketik *A*, *B*, atau *C*."
                );
                break;

            // --- TAHAP 5: STATUS PELAPOR ---
            case 'tanya_status_pelapor':
                $pilihan = strtoupper($message);
                if ($pilihan == 'A') {
                    $this->simpanDataSementara($sender, 'status_pelapor', 'Mahasiswa', 'tanya_identitas');
                    $this->balasPesan($sender, "5. Masukkan NIM Anda:");
                } elseif ($pilihan == 'B') {
                    $this->simpanDataSementara($sender, 'status_pelapor', 'Dosen', 'tanya_identitas');
                    $this->balasPesan($sender, "5. Masukkan NIP Anda:");
                } elseif ($pilihan == 'C') {
                    $this->updateSession($sender, 'tanya_status_custom', $session['data']);
                    $this->balasPesan($sender, "Silakan ketik status Anda (Misal: Satpam, Staff, Tamu):");
                } else {
                    $this->balasPesan($sender, "🚫 Pilihan tidak tersedia. Ketik *A*, *B*, atau *C*.");
                }
                break;

            // --- TAHAP 5B: STATUS CUSTOM ---
            case 'tanya_status_custom':
                $this->simpanDataSementara($sender, 'status_pelapor', $message, 'tanya_identitas');
                $this->balasPesan($sender, "5. Masukkan Nomor Identitas (KTP/NIP/NIM):");
                break;

            // --- TAHAP 6: IDENTITAS ---
            case 'tanya_identitas':
                $this->simpanDataSementara($sender, 'nim_nip', $message, 'tanya_deskripsi');
                $this->balasPesan($sender, "6. Terakhir, berikan deskripsi/ciri-ciri detail barang tersebut (Warna, Merk, dll):");
                break;

            // --- TAHAP 7: FINALISASI ---
            case 'tanya_deskripsi':
                $data = $session['data'];
                $tipe = $data['tipe'];

                try {
                    if ($tipe == 'lost') {
                        $item = LostItem::create([
                            'nama_barang'        => $data['nama_barang'],
                            'lokasi_terakhir'    => $data['lokasi'],
                            'tanggal_kehilangan' => $data['tanggal'],
                            'deskripsi'          => $message,
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

                    // Hapus sesi setelah sukses
                    Cache::forget($cacheKey);
                    $this->balasPesan($sender, "✅ Terima kasih!\n$pesanSukses\n\nAdmin akan segera memverifikasi laporan ini.");
                } catch (\Exception $e) {
                    Log::error("Gagal simpan DB: " . $e->getMessage());
                    $this->balasPesan($sender, "Maaf, terjadi kesalahan sistem saat menyimpan data. Silakan coba lagi nanti.");
                }
                break;

            default:
                $this->updateSession($sender, 'pilih_kategori', []);
                $this->balasPesan($sender, "Halo! Ketik *Menu* untuk memulai laporan.");
                break;
        }

        // PENTING: Selalu return OK ke Fonnte agar webhook tidak dianggap gagal
        return response('OK', 200);
    }

    // --- HELPER FUNCTIONS ---

    // Fungsi update sesi
    private function updateSession($sender, $nextStep, $data)
    {
        Cache::put('wa_session_' . $sender, ['step' => $nextStep, 'data' => $data], 600); // 10 menit
    }

    // Fungsi simpan data sementara
    private function simpanDataSementara($sender, $key, $value, $nextStep)
    {
        $cacheKey = 'wa_session_' . $sender;
        $session = Cache::get($cacheKey);
        $session['data'][$key] = $value;
        $session['step'] = $nextStep;
        Cache::put($cacheKey, $session, 600);
    }

    /**
     * FUNGSI KRUSIAL: MENGIRIM PESAN MENGGUNAKAN API FONNTE
     * Menggunakan Http Client Laravel agar lebih stabil.
     */
    private function balasPesan($target, $pesan)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'), // Ambil Token dari .env
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $pesan,
                'delay' => '1', // Delay 1 detik agar terlihat natural
            ]);

            // Log respons dari Fonnte (untuk cek sukses/gagal)
            Log::info("Balas ke $target: " . $response->body());
        } catch (\Exception $e) {
            Log::error("Gagal Mengirim WA: " . $e->getMessage());
        }
    }
}