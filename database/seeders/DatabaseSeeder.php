<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            GaleriSeeder::class,
            BeritaSeeder::class,
            InformasiSeeder::class,
            BannerSeeder::class,
            UmkmSeeder::class,
            DestinasiSeeder::class,
            KontakSeeder::class,
        ]);
    }
}