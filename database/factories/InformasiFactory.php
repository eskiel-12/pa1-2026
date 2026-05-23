<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Informasi>
 */
class InformasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();

        return [
            'judul' => $title,
            'slug' => Str::slug($title),
            'konten' => $this->faker->paragraphs(3, true),
            'kategori' => $this->faker->randomElement(['Budaya', 'Sejarah', 'Tradisi']),
            'gambar' => null,
            'penulis' => $this->faker->name(),
            'status' => true,
            'views' => 0,
        ];
    }
}
