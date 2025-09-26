<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoundItem>
 */
class FoundItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => fake()->words(3, true), // Contoh: "Dompet Kulit Coklat"
            'deskripsi' => fake()->sentence(10), // Contoh: "Ditemukan dompet berisi KTP dan beberapa kartu..."
            'lokasi_penemuan' => fake()->randomElement(['Perpustakaan', 'Kantin', 'Gedung A', 'Masjid Kampus', 'Area Parkir']),
            'tanggal_penemuan' => fake()->dateTimeBetween('-1 month', 'now'), // Tanggal acak dalam sebulan terakhir
        ];
    }
}
