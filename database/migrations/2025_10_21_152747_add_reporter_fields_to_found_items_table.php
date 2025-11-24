<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('found_items', function (Blueprint $table) {
            $table->string('nama_pelapor');
            $table->string('no_telp')->nullable();
            $table->string('status_pelapor'); // (Mahasiswa, Dosen, Lainnya)
            $table->string('NIM_NIP')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('found_items', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'no_telp', 'status_pelapor', 'NIM_NIP']);
        });
    }
};
