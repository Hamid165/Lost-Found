<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class LostItem
 *
 * Model ini merepresentasikan tabel 'lost_items' di database.
 * Digunakan untuk menyimpan data laporan barang yang hilang.
 */
class LostItem extends Model
{
    // Menggunakan trait HasFactory untuk keperluan testing (Factory).
    // @use HasFactory<\Database\Factories\LostItemFactory>
    use HasFactory;

    /**
     * Properti $fillable menentukan kolom mana saja yang boleh diisi secara massal (Mass Assignment).
     *
     * Mass Assignment adalah saat data disimpan sekaligus dari array, misal: LostItem::create($data).
     * Kolom yang tidak terdaftar di sini tidak akan bisa diupdate via mass assignment demi keamanan.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_barang',          // Nama barang yang hilang
        'deskripsi',            // Detail ciri-ciri barang
        'lokasi_terakhir',      // Lokasi terakhir barang terlihat/diketahui
        'tanggal_kehilangan',   // Waktu kehilangan
        'status',               // Status laporan (misal: 'Masih Hilang', 'Sudah Dikembalikan')
        'nama_pelapor',         // Nama pelapor kehilangan
        'no_telp',              // Kontak pelapor (opsional)
        'status_pelapor',       // Status pelapor (Mahasiswa/Dosen/dll)
        'NIM_NIP',              // Identitas tambahan pelapor (opsional)
    ];

    /**
     * [TAMBAHAN BARU]
     * Mengubah format kolom tanggal otomatis menjadi Object Carbon.
     * Ini memudahkan formatting tanggal di view (misal: $item->tanggal_kehilangan->format('d-m-Y'))
     */
    protected $casts = [
        'tanggal_kehilangan' => 'date',
    ];

    /**
     * Method 'booted' dijalankan secara otomatis saat model diinisialisasi oleh Framework.
     *
     * Digunakan di sini untuk mendengarkan event 'creating' (saat data baru akan dibuat).
     * Fungsi: Mengisi kolom 'uuid' secara otomatis dengan UUID v4 sebelum data masuk ke database.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            // Jika UUID belum diisi manual, generate UUID baru
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Menentukan kolom yang digunakan untuk pencarian model saat menggunakan Route Model Binding.
     *
     * Secara default, Laravel menggunakan kolom 'id' (Auto Increment Integer).
     * Kita override menjadi 'uuid' agar URL menggunakan string UUID yang unik dan acak.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}