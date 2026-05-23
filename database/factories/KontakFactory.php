<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KontakFactory extends Factory
{
    public function definition(): array
    {
        return [
            'alamat'           => $this->faker->address(),
            'telepon_1'        => $this->faker->numerify('08##########'),
            'telepon_2'        => null,
            'telepon_3'        => null,
            'email_1'          => $this->faker->unique()->safeEmail(),
            'email_2'          => null,
            'email_3'          => null,
            'jam_buka_kerja'   => '08:00',
            'jam_tutup_kerja'  => '17:00',
            'jam_buka_weekend' => null,
            'jam_tutup_weekend'=> null,
            'facebook'         => null,
            'instagram'        => null,
            'twitter'          => null,
            'youtube'          => null,
            'tiktok'           => null,
            'maps_url'         => null,
        ];
    }
}