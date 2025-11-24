<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LostItem extends Model
{
    // PERBAIKAN 1: Definisikan tipe Factory-nya agar lolos Generic Check
    /** @use HasFactory<\Database\Factories\LostItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * PERBAIKAN 2: Ubah tipe data menjadi list<string> agar covariant dengan parent Model
     * @var list<string>
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