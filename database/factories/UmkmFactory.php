<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UmkmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(),
            'deskripsi' => $this->faker->paragraph(),
            'gambar' => 'test-umkm.jpg', // Berikan nilai default agar lolos NOT NULL
            'lokasi' => $this->faker->city(),
            'kontak' => $this->faker->phoneNumber(),
        ];
    }
}