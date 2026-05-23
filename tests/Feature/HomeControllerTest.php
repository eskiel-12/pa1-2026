<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Banner;
use App\Models\Destinasi;
use App\Models\Umkm;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test home page index
     */
    public function test_home_index_page(): void
    {
        // Membuat Kategori secara manual untuk menghindari error status
        $kategori = new Kategori();
        $kategori->nama = 'Kategori Dummy';
        $kategori->slug = 'kategori-dummy';
        $kategori->deskripsi = 'Deskripsi dummy untuk testing';
        $kategori->save();

        Galeri::factory()->count(8)->create([
            'status' => true,
            'kategori_id' => $kategori->id,
            'gambar' => 'dummy-gambar.jpg',
        ]);

        Berita::factory()->count(5)->create([
            'status' => true,
            'kategori_id' => $kategori->id,
            'gambar' => 'dummy-gambar.jpg',
        ]);

        // 👇 INI YANG KITA PERBAIKI 👇
        Banner::factory()->count(3)->create([
            'status' => true,
            'gambar' => 'dummy-gambar.jpg',
            'url_gambar' => 'https://example.com/dummy-banner.jpg', // Tambahan wajib!
        ]);

        Destinasi::factory()->count(6)->create([
            'status' => true,
            'gambar' => 'dummy-gambar.jpg',
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHasAll(['galeri', 'berita', 'destinasi', 'banners']);
    }

    /**
     * Test UMKM page
     */
    public function test_umkm_page(): void
    {
        Umkm::factory()->count(5)->create([
            'gambar' => 'dummy-gambar.jpg'
        ]);

        $response = $this->get(route('umkm'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.umkm');
        $response->assertViewHas('umkms');
    }

    /**
     * Test budaya page
     */
    public function test_budaya_page(): void
    {
        Informasi::factory()->count(5)->create([
            'status' => true,
            'kategori' => 'Budaya',
        ]);

        $response = $this->get(route('budaya'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.budaya');
        $response->assertViewHas('budayaItems');
    }

    /**
     * Test home page with no data
     */
    public function test_home_page_with_no_data(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHasAll(['galeri', 'berita', 'destinasi', 'banners']);
    }
}