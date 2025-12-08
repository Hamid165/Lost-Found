<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class FoundItem
 *
 * Model ini merepresentasikan tabel 'found_items' di database.
 * Digunakan untuk menyimpan data laporan barang yang ditemukan.
 */
class FoundItem extends Model
{
    // Menggunakan trait HasFactory untuk keperluan testing (Factory).
    // @use HasFactory<\Database\Factories\FoundItemFactory>
    use HasFactory;

    /**
     * Properti $fillable menentukan kolom mana saja yang boleh diisi secara massal (Mass Assignment).
     *
     * Mass Assignment adalah saat kita menyimpan data sekaligus dari array, contoh:
     * FoundItem::create($request->all());
     *
     * Tanpa mendaftarkan kolom di sini, Laravel akan mengabaikan input tersebut demi keamanan.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_barang',      // Nama barang yang ditemukan
        'deskripsi',        // Detail ciri-ciri barang
        'lokasi_penemuan',  // Tempat ditemukannya barang
        'tanggal_penemuan', // Waktu ditemukannya barang
        'status',           // Status laporan (misal: 'Belum Diambil', 'Sudah Diambil')
        'nama_pelapor',     // Nama orang yang menemukan
        'no_telp',          // Kontak penemu (opsional)
        'status_pelapor',   // Status penemu (Mahasiswa/Dosen/dll)
        'NIM_NIP',          // Identitas tambahan penemu (opsional)
    ];

    /**
     * Method 'booted' dijalankan otomatis saat model diinisialisasi.
     *
     * Di sini kita menggunakan Event 'creating' untuk mengisi kolom 'uuid' secara otomatis
     * sebelum data disimpan ke database. Ini memastikan setiap item memiliki ID unik yang acak.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            // Jika kolom uuid masih kosong, buat UUID baru.
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Menentukan kolom yang digunakan sebagai kunci pencarian di Routing (Route Model Binding).
     *
     * Secara default, Laravel mencari berdasarkan 'id'.
     * Di sini kita ubah menjadi 'uuid' agar URL lebih aman dan tidak mudah ditebak.
     * Contoh URL: /items/found/123e4567-e89b-12d3-a456-426614174000 (bukan /items/found/1)
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}