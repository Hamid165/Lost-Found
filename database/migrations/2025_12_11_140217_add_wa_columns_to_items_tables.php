<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. UPDATE TABEL BARANG HILANG (lost_items)
        Schema::table('lost_items', function (Blueprint $table) {

            // Tambahkan kolom 'nama_pelapor' jika belum ada
            if (!Schema::hasColumn('lost_items', 'nama_pelapor')) {
                $table->string('nama_pelapor')->nullable()->after('deskripsi');
            }

            // Tambahkan kolom 'no_telp' (PENTING untuk WA)
            if (!Schema::hasColumn('lost_items', 'no_telp')) {
                $table->string('no_telp')->nullable()->after('nama_pelapor');
            }

            // Tambahkan status pelapor (Mahasiswa/Dosen/dll)
            if (!Schema::hasColumn('lost_items', 'status_pelapor')) {
                $table->string('status_pelapor')->nullable()->after('no_telp');
            }

            // Tambahkan NIM/NIP
            if (!Schema::hasColumn('lost_items', 'NIM_NIP')) {
                $table->string('NIM_NIP')->nullable()->after('status_pelapor');
            }

            // Pastikan kolom status ada (biasanya sudah ada, tapi buat jaga-jaga)
            if (!Schema::hasColumn('lost_items', 'status')) {
                $table->string('status')->default('Masih Hilang');
            }
        });

        // 2. UPDATE TABEL BARANG DITEMUKAN (found_items)
        Schema::table('found_items', function (Blueprint $table) {
            if (!Schema::hasColumn('found_items', 'nama_pelapor')) {
                $table->string('nama_pelapor')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('found_items', 'no_telp')) {
                $table->string('no_telp')->nullable()->after('nama_pelapor');
            }
            if (!Schema::hasColumn('found_items', 'status_pelapor')) {
                $table->string('status_pelapor')->nullable()->after('no_telp');
            }
            if (!Schema::hasColumn('found_items', 'NIM_NIP')) {
                $table->string('NIM_NIP')->nullable()->after('status_pelapor');
            }
            if (!Schema::hasColumn('found_items', 'status')) {
                $table->string('status')->default('Belum Diambil');
            }
        });
    }

    public function down(): void
    {
        // Kalau di-rollback, hapus kolom-kolom tambahan tadi
        Schema::table('lost_items', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'no_telp', 'status_pelapor', 'NIM_NIP']);
        });

        Schema::table('found_items', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'no_telp', 'status_pelapor', 'NIM_NIP']);
        });
    }
};
