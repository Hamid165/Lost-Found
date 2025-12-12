<?php

namespace App\Models;

// Mengimpor interface MustVerifyEmail untuk fitur verifikasi email
use Illuminate\Contracts\Auth\MustVerifyEmail;
// Mengimpor trait yang berisi logika verifikasi email
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * Model ini merepresentasikan pengguna aplikasi (tabel 'users').
 * Mengimplementasikan Authenticatable untuk fitur login/auth
 * dan MustVerifyEmail (opsional/jika diaktifkan) untuk verifikasi email.
 */
class User extends Authenticatable
{
    // HasFactory: Untuk membuat fake data saat testing/seeding.
    // Notifiable: Agar user bisa menerima notifikasi (via email/dll).
    // MustVerifyEmailTrait: Trait pelengkap logika verifikasi email.

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, MustVerifyEmailTrait;

    /**
     * Properti $fillable menentukan kolom mana saja yang boleh diisi secara massal (Mass Assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',             // Nama lengkap user
        'email',            // Alamat email user
        'password',         // Password (akan di-hash)
        'google_id',        // ID dari Google (jika login via Google)
        'profile_photo_path', // Path penyimpanan foto profil
        'role',             // Peran user (misal: 'user' atau 'admin')
        'no_telp',          // Nomor telepon user
    ];

    /**
     * Properti $hidden menentukan kolom yang TIDAK BOLEH disertakan saat model diubah menjadi Array atau JSON.
     * Biasanya untuk data sensitif seperti password dan token.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Method casts() digunakan untuk mengubah tipe data kolom secara otomatis saat diakses.
     *
     * Contoh:
     * - 'email_verified_at' di database berupa string, diubah jadi objek Carbon (datetime).
     * - 'password' akan otomatis di-hash saat diset.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Helper Method: isAdmin()
     *
     * Mengecek apakah user memiliki peran sebagai admin.
     * Digunakan untuk membatasi akses ke halaman/fitur tertentu.
     *
     * @return bool True jika role user adalah 'admin'.
     */
    public function isAdmin(): bool
    {
        // Membandingkan kolom role dengan string 'admin' secara strict (===)
        return $this->role === 'admin';
    }
}
