<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeri>
 */
class GaleriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);

        return [
            'judul' => $title,
            'slug' => Str::slug($title),
            'kategori' => 'Galeri',
            'deskripsi' => $this->faker->paragraph(),
            'gambar' => null,
            'url_gambar' => null,
            'lokasi' => $this->faker->city(),
            'tanggal_foto' => $this->faker->date(),
            'status' => true,
            'views' => 0,
        ];
    }
}
