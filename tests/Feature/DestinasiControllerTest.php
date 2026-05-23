<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinasiControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test showing all destinasi
     */
    public function test_show_all_destinasi(): void
    {
        Destinasi::factory()->count(5)->create(['status' => true]);

        // Menggunakan nama route yang sesuai dengan web.php kamu
        $response = $this->get(route('destinasi'));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.index');
    }

    /**
     * Test show single destinasi with complete optional fields (url_gambar & maps exist)
     */
    public function test_show_single_destinasi_with_optional_fields(): void
    {
        // Membuat data destinasi di mana url_gambar dan maps terisi
        $destinasi = Destinasi::factory()->create([
            'status' => true,
            'gambar' => 'default.jpg',
            'url_gambar' => 'https://example.com/image.jpg',
            'maps' => 'https://maps.google.com/?q=danau+toba',
            'lokasi' => 'Danau Toba, Sumatera Utara'
        ]);

        $response = $this->get(route('destinasi.show', $destinasi->id));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.detail');
        $response->assertViewHas('destinasi');

        // Memastikan logika ternary operator terpenuhi (mengambil url_gambar dan membuat embed_maps)
        $viewDestinasi = $response->viewData('destinasi');
        $this->assertEquals('https://example.com/image.jpg', $viewDestinasi->galeri[1]);
        $this->assertNotNull($viewDestinasi->embed_maps);
    }

    /**
     * Test show single destinasi without optional fields (url_gambar & maps are null)
     */
    public function test_show_single_destinasi_without_optional_fields(): void
    {
        // Membuat data destinasi di mana url_gambar dan maps kosong/null
        $destinasi = Destinasi::factory()->create([
            'status' => true,
            'gambar' => 'default.jpg',
            'url_gambar' => null,
            'maps' => null,
            'lokasi' => 'Danau Toba, Sumatera Utara'
        ]);

        $response = $this->get(route('destinasi.show', $destinasi->id));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.detail');
        $response->assertViewHas('destinasi');

        // Memastikan logika fallback ternary operator terpenuhi
        $viewDestinasi = $response->viewData('destinasi');
        $this->assertEquals('default.jpg', $viewDestinasi->galeri[1]); // Fallback ke gambar
        $this->assertNull($viewDestinasi->embed_maps); // Karena maps null, embed_maps juga harus null
    }

    /**
     * Test show not found destinasi
     */
    public function test_show_not_found_destinasi(): void
    {
        $response = $this->get(route('destinasi.show', 9999));

        $response->assertStatus(404);
    }

    /**
     * Test show inactive destinasi (status = false)
     */
    public function test_show_inactive_destinasi_returns_404(): void
    {
        // Pastikan destinasi yang statusnya false tidak bisa diakses di detail
        $destinasi = Destinasi::factory()->create(['status' => false]);

        $response = $this->get(route('destinasi.show', $destinasi->id));

        $response->assertStatus(404);
    }

    /**
     * Test destinasi alam category
     */
    public function test_destinasi_alam(): void
    {
        Destinasi::factory()->count(15)->create([
            'status' => true,
            'kategori' => 'Alam',
        ]);

        $response = $this->get(route('destinasi.alam'));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.kategori');
    }

    /**
     * Test destinasi buatan category
     */
    public function test_destinasi_buatan(): void
    {
        Destinasi::factory()->count(15)->create([
            'status' => true,
            'kategori' => 'Buatan',
        ]);

        $response = $this->get(route('destinasi.buatan'));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.kategori');
    }

    /**
     * Test destinasi budaya category
     */
    public function test_destinasi_budaya(): void
    {
        Destinasi::factory()->count(15)->create([
            'status' => true,
            'kategori' => 'Budaya',
        ]);

        $response = $this->get(route('destinasi.budaya'));

        $response->assertStatus(200);
        $response->assertViewIs('destinasi.kategori');
    }
}