<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destinasi>
 */
class DestinasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'nama' => $name,
            'slug' => Str::slug($name),
            'gambar' => null,
            'deskripsi' => $this->faker->paragraph(),
            'lokasi' => $this->faker->city(),
            'kategori' => $this->faker->randomElement(['Alam', 'Buatan', 'Budaya']),
            'tags' => json_encode([$this->faker->word(), $this->faker->word()]),
            'maps' => null,
            'status' => true,
            'views' => 0,
            'url_gambar' => null,
        ];
    }
}
