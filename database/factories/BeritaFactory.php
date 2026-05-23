<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{
        return [
            'judul' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'konten' => $this->faker->paragraph(),
            'gambar' => 'default-berita.jpg', // Tambahkan ini agar tidak NULL
            'penulis' => $this->faker->name(),
            'tanggal_terbit' => $this->faker->date(),
            'status' => true,
            'views' => 0,
            'komentar' => 0,
            'kategori_id' => \App\Models\Kategori::factory(), // Pastikan relasi aman
        ];
    }
}
