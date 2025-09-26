<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FoundItem; // <-- Tambahkan ini
use App\Models\LostItem;  // <-- Tambahkan ini
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus komentar dan jalankan factory
        FoundItem::factory(25)->create();
        LostItem::factory(25)->create();

        // Membuat satu user admin untuk testing
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin', // <-- Set rolenya menjadi admin
        ]);
    }
}
