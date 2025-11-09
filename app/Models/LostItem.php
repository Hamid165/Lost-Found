<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- 1. PASTIKAN IMPORT INI ADA

class LostItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'lokasi_terakhir',
        'tanggal_kehilangan',
        'status',
        'nama_pelapor',
        'no_telp',
        'status_pelapor',
        'NIM_NIP',
    ];

    /**
     * 2. TAMBAHKAN FUNGSI INI
     * The "booted" method of the model.
     * Otomatis mengisi kolom 'uuid' saat data baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * 3. TAMBAHKAN FUNGSI INI
     * Get the route key for the model.
     * Memberitahu Laravel untuk menggunakan 'uuid' di URL, bukan 'id'.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
