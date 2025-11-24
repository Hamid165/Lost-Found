# Lost & Found Kampus 🗺️✨

![Framework](https://img.shields.io/badge/Framework-Laravel_12-FF2D20.svg)
![Platform](https://img.shields.io/badge/Platform-Web-blue)
![Keamanan](https://img.shields.io/badge/Security-Hardened-brightgreen.svg)
![Status](https://img.shields.io/badge/Status-Development-orange.svg)

Platform terpusat untuk melaporkan dan menemukan barang hilang di lingkungan kampus dengan mudah, cepat, dan aman.

## 📖 Deskripsi

**Lost & Found Kampus** adalah aplikasi web berbasis Laravel 12 yang dirancang untuk mengatasi masalah barang hilang di lingkungan kampus. Aplikasi ini menyediakan platform terpusat di mana mahasiswa, dosen, dan staf dapat melaporkan barang yang hilang atau ditemukan.

Fitur utamanya mencakup sistem autentikasi lengkap (termasuk login Google), galeri barang, manajemen profil, dan dashboard admin khusus untuk mengelola semua laporan. Proyek ini juga telah diperkuat dengan praktik keamanan modern (CSP, XSS, SQLi Protection) untuk melindungi data pengguna.

## 🚀 Fitur Utama

* **Lapor Barang:** Pengguna dapat dengan mudah melaporkan barang yang hilang atau ditemukan.
* **Galeri Barang:** Melihat semua daftar laporan barang dalam satu galeri terpusat.
* **Login & Register:** Sistem autentikasi lengkap, termasuk login via **Google**.
* **Dashboard Admin:** Halaman khusus untuk Admin mengelola (edit/hapus) semua laporan.
* **Manajemen Profil:** Pengguna dapat meng-update profil dan foto mereka.

## 🛡️ Fitur Keamanan (Telah Diperkuat)

Proyek ini telah diperkuat dengan praktik keamanan modern untuk melindungi data pengguna:

* **Content Security Policy (CSP):** Mencegah serangan XSS dan *data injection*.
* **Proteksi Clickjacking:** Mencegah website di-Embed di situs lain (`X-Frame-Options`).
* **Aman dari SQL Injection:** Menggunakan *Parameterized Queries*.
* **Aman dari XSS:** Melakukan sanitasi *input* dan *output*.
* **Proteksi CSRF:** Semua form dilindungi oleh token CSRF.

## 💻 Tumpukan Teknologi

* **Backend:** Laravel 12, PHP 8.2+
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Auth:** Laravel Breeze, Laravel Socialite
* **Build Tool:** Vite

## ⚙️ Memulai (Getting Started)

### Prasyarat (Dependencies)

Pastikan Anda memiliki perangkat lunak berikut sebelum instalasi:

* PHP 8.2+
* Composer
* Node.js & NPM
* Database (MySQL, MariaDB, dll.)

### Instalasi

1.  Clone repositori ini:
    ```bash
    git clone https://github.com/hamid165/lost-found.git
    ```
2.  Masuk ke direktori proyek:
    ```bash
    cd lost-found
    ```
3.  Instal dependensi PHP:
    ```bash
    composer install
    ```
4.  Instal dependensi JavaScript:
    ```bash
    npm install
    ```
5.  Salin file `.env` contoh dan buat kunci aplikasi:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
6.  Konfigurasikan file `.env` Anda dengan detail koneksi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
7.  Jalankan migrasi database (dan *seeder* untuk akun admin):
    ```bash
    php artisan migrate --seed
    ```

### Menjalankan Program

1.  Jalankan server *build* Vite (untuk CSS/JS):
    ```bash
    npm run dev
    ```
2.  Di terminal lain, jalankan server Laravel:
    ```bash
    php artisan serve
    ```
3.  Buka `http://127.0.0.1:8000` di browser Anda 🚀

## 🤔 Bantuan (Help)

Masalah paling umum saat menjalankan di lokal adalah CSS/JS tidak ter-load karena *Content Security Policy (CSP)*. Ini normal. Proyek ini dikonfigurasi untuk mengizinkan server Vite (`localhost`/`127.0.0.1`) hanya saat `APP_ENV=local`.

Jika CSS/JS masih terblokir:

* Pastikan Anda telah me-*restart* server `npm run dev`.
* Bersihkan *cache* Laravel: `php artisan view:clear`
* Lakukan **Hard Refresh** di browser Anda (`Ctrl+Shift+R`).

## 👨‍💻 Penulis

* **Hamid** - *Developer*
    * [@hamid165](https://github.com/hamid165)

## 🕒 Riwayat Versi

* **1.0.0**
    * Rilis awal.

* **1.2.0**
    *  Perbaikan keamanan (CSP, XSS, SQLi) dan fitur inti.

## 📄 Lisensi

Proyek ini dilisensikan di bawah **HAMID License** - lihat file `composer.json` untuk detailnya.

## 🙏 Ucapan Terima Kasih

* Laravel
* Tailwind CSS
* Alpine.js
