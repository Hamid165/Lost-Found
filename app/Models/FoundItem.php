<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- 1. Pastikan import ini ada

class FoundItem extends Model
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
        'lokasi_penemuan', // <-- 2. INI PERBAIKANNYA
        'tanggal_penemuan', // <-- 3. INI PERBAIKANNYA
        'status',
        'nama_pelapor',
        'no_telp',
        'status_pelapor',
        'NIM_NIP',
    ];

    /**
     * 4. WAJIB TAMBAHKAN FUNGSI INI (untuk UUID)
     * The "booted" method of the model.
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
     * 5. WAJIB TAMBAHKAN FUNGSI INI (untuk UUID)
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
