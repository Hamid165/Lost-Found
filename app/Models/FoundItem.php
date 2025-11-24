<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FoundItem extends Model
{
    // PERBAIKAN 1: Tambahkan @use untuk mendefinisikan tipe Factory
    /** @use HasFactory<\Database\Factories\FoundItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * PERBAIKAN 2: Ubah array<int, string> menjadi list<string>
     * @var list<string>
     */
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'lokasi_penemuan',
        'tanggal_penemuan',
        'status',
        'nama_pelapor',
        'no_telp',
        'status_pelapor',
        'NIM_NIP',
    ];

    /**
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}