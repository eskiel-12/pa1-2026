<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak::updateOrCreate(
            ['id' => 1],
            [
                'alamat' => 'Pulau Sibandang, Danau Toba, Sumatera Utara, Indonesia',
                'telepon_1' => '+62 812 3456 7890',
                'telepon_2' => '+62 813 9876 5432',
                'telepon_3' => '(0622) 12345',
                'email_1' => 'info@geotoba.com',
                'email_2' => 'reservasi@geotoba.com',
                'email_3' => 'support@geotoba.com',
                'jam_buka_kerja' => '08:00',
                'jam_tutup_kerja' => '17:00',
                'jam_buka_weekend' => '08:00',
                'jam_tutup_weekend' => '18:00',
                'facebook' => 'https://facebook.com/geositedanautoba',
                'instagram' => 'https://instagram.com/geositedanautoba',
                'twitter' => 'https://twitter.com/geositedanautoba',
                'youtube' => 'https://youtube.com/@geositedanautoba',
                'tiktok' => 'https://tiktok.com/@geositedanautoba',
                'maps_url' => 'https://www.google.com/maps?q=Muara,Tapanuli+Utara&output=embed',
            ]
        );
    }
}
