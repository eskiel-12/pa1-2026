<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_page_without_query(): void
    {
        $response = $this->get(route('search'));
        $response->assertStatus(200);
    }

    public function test_search_berita(): void
    {
        $kategori = Kategori::factory()->create();
        
        Berita::factory()->create([
            'judul' => 'Testing Laravel Framework',
            'status' => true,
            'kategori_id' => $kategori->id,
            'gambar' => 'test.jpg', // TAMBAHKAN INI
        ]);

        $response = $this->get(route('search', ['q' => 'Laravel']));
        $response->assertStatus(200);
        $response->assertSee('Testing Laravel Framework');
    }

    public function test_search_destinasi(): void
    {
        Destinasi::factory()->create([
            'nama' => 'Danau Toba',
            'status' => true,
            'gambar' => 'toba.jpg' // TAMBAHKAN INI
        ]);

        $response = $this->get(route('search', ['q' => 'Danau']));
        $response->assertStatus(200);
    }

    public function test_search_informasi(): void
    {
        Informasi::factory()->create([
            'judul' => 'Sejarah Budaya Batak',
            'status' => true,
            // Jika Informasi juga punya gambar NOT NULL, tambahkan:
            // 'gambar' => 'info.jpg', 
        ]);

        $response = $this->get(route('search', ['q' => 'Sejarah']));
        $response->assertStatus(200);
    }

    public function test_search_no_results(): void
    {
        $response = $this->get(route('search', ['q' => 'NonExistentQuery12345']));
        $response->assertStatus(200);
    }
}