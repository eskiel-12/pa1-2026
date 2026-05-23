<?php

namespace Tests\Feature;

use App\Models\Umkm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeositeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sibandang geosite page
     */
    public function test_sibandang_geosite(): void
    {
        // Membuat 5 data dummy UMKM dan secara eksplisit mengisi kolom 'gambar'
        // agar tidak terkena error NOT NULL constraint dari database.
        Umkm::factory()->count(5)->create([
            'gambar' => 'dummy-gambar.jpg'
        ]);

        $response = $this->get(route('geosite.sibandang'));

        $response->assertStatus(200);
        $response->assertViewIs('geosite.sibandang');
        $response->assertViewHas('umkm');
    }

    /**
     * Test muara geosite page
     */
    public function test_muara_geosite(): void
    {
        $response = $this->get(route('geosite.muara'));

        $response->assertStatus(200);
        $response->assertViewIs('geosite.muara');
    }

    /**
     * Test sampuran geosite page
     */
    public function test_sampuran_geosite(): void
    {
        $response = $this->get(route('geosite.sampuran'));

        $response->assertStatus(200);
        $response->assertViewIs('geosite.sampuran');
    }

    /**
     * Test papande geosite page
     */
    public function test_papande_geosite(): void
    {
        $response = $this->get(route('geosite.papande'));

        $response->assertStatus(200);
        $response->assertViewIs('geosite.papande');
    }
}