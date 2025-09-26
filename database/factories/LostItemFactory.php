<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostItem>
 */
class LostItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => fake()->words(3, true),
            'deskripsi' => fake()->sentence(10),
            'lokasi_terakhir' => fake()->randomElement(['Perpustakaan', 'Kantin', 'Gedung A', 'Masjid Kampus', 'Area Parkir']),
            'tanggal_kehilangan' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
