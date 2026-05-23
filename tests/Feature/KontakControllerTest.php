<?php

namespace Tests\Feature;

use App\Models\Kontak;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KontakControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test menampilkan halaman kontak
     */
    public function test_index_page(): void
    {
        $response = $this->get(route('kontak'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.kontak');
        $response->assertViewHas('kontak');
    }

    /**
     * Test mengirim pesan kontak berhasil
     */
    public function test_store_message_success(): void
    {
        $response = $this->post(route('kontak.storeMessage'), [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'telepon' => '08123456789',
            'subjek' => 'Pertanyaan Baru',
            'pesan' => 'Halo, ini adalah pesan tes.'
        ]);

        $response->assertRedirect(route('kontak'));
        $response->assertSessionHas('success', 'Pesan Anda telah dikirim!');
    }

    /**
     * Test validasi gagal jika data kosong
     */
    public function test_store_message_validation_fails(): void
    {
        $response = $this->post(route('kontak.storeMessage'), [
            'nama' => '', // Kosongkan wajib diisi
            'email' => 'bukan-email', // Email tidak valid
        ]);

        $response->assertSessionHasErrors(['nama', 'email', 'subjek', 'pesan']);
    }
}