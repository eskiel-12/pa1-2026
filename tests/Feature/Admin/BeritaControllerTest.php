<?php

namespace Tests\Feature\Admin;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeritaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $kategori;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        
        $this->user = User::factory()->create();
        
        $this->kategori = new Kategori();
        $this->kategori->nama = 'Kategori Berita Test';
        $this->kategori->slug = 'kategori-berita-test';
        $this->kategori->deskripsi = 'Deskripsi dummy';
        $this->kategori->save();
    }

    public function test_index_page(): void
    {
        Berita::factory()->count(3)->create([
            'kategori_id' => $this->kategori->id,
            'gambar' => 'dummy.jpg',
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.berita.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.berita.index');
        $response->assertViewHas('berita');
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.berita.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.berita.create');
        $response->assertViewHas('kategori');
    }

    public function test_store_berita_success(): void
    {
        $file = UploadedFile::fake()->image('berita1.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.berita.store'), [
            'judul' => 'Judul Berita Baru',
            'konten' => 'Isi berita panjang lebar',
            'gambar' => $file,
            'kategori_id' => $this->kategori->id,
            'tanggal_terbit' => '2026-05-23',
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseHas('berita', [
            'judul' => 'Judul Berita Baru',
            'slug' => 'judul-berita-baru',
            'penulis' => 'Admin', 
            'status' => false,
        ]);
    }

    public function test_store_berita_with_duplicate_slug_generates_unique_slug(): void
    {
        Berita::factory()->create([
            'judul' => 'Judul Berita Sama',
            'slug' => 'judul-berita-sama',
            'kategori_id' => $this->kategori->id,
            'gambar' => 'dummy.jpg'
        ]);

        $file = UploadedFile::fake()->image('berita2.jpg');
        
        $response = $this->actingAs($this->user)->post(route('admin.berita.store'), [
            'judul' => 'Judul Berita Sama',
            'konten' => 'Konten berbeda',
            'gambar' => $file,
            'kategori_id' => $this->kategori->id,
            'tanggal_terbit' => '2026-05-23',
            'penulis' => 'Penulis Custom',
            'status' => 'on', 
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseHas('berita', [
            'konten' => 'Konten berbeda',
            'penulis' => 'Penulis Custom',
            'status' => true,
        ]);
        
        $beritaBaru = Berita::where('konten', 'Konten berbeda')->first();
        $this->assertStringContainsString('judul-berita-sama-', $beritaBaru->slug);
    }

    public function test_edit_page(): void
    {
        $berita = Berita::factory()->create([
            'kategori_id' => $this->kategori->id,
            'gambar' => 'dummy.jpg',
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.berita.edit', $berita->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.berita.edit');
    }

    public function test_update_berita_without_image_keeps_old_image(): void
    {
        $berita = Berita::factory()->create([
            'judul' => 'Judul Asli',
            'slug' => 'judul-asli',
            'kategori_id' => $this->kategori->id,
            'gambar' => 'dummy-lama.jpg',
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.berita.update', $berita->id), [
            'judul' => 'Judul Asli', 
            'konten' => 'Konten update',
            'kategori_id' => $this->kategori->id,
            'tanggal_terbit' => '2026-06-01',
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'konten' => 'Konten update',
            'slug' => 'judul-asli', 
            'gambar' => 'dummy-lama.jpg', 
        ]);
    }

    public function test_update_berita_with_new_image_deletes_old(): void
    {
        $oldImage = UploadedFile::fake()->image('old-berita.jpg');
        $oldImagePath = $oldImage->storeAs('berita', 'old-berita.jpg', 'public');

        $berita = Berita::factory()->create([
            'kategori_id' => $this->kategori->id,
            'gambar' => $oldImagePath,
        ]);

        $newImage = UploadedFile::fake()->image('new-berita.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.berita.update', $berita->id), [
            'judul' => 'Judul Update',
            'konten' => 'Konten update image',
            'kategori_id' => $this->kategori->id,
            'tanggal_terbit' => '2026-06-01',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        
        Storage::disk('public')->assertMissing($oldImagePath);
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseMissing('berita', [
            'gambar' => $oldImagePath,
        ]);
    }

    public function test_destroy_berita_with_existing_image(): void
    {
        $image = UploadedFile::fake()->image('delete-me.jpg');
        $imagePath = $image->storeAs('berita', 'delete-me.jpg', 'public');

        $berita = Berita::factory()->create([
            'kategori_id' => $this->kategori->id,
            'gambar' => $imagePath,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.berita.destroy', $berita->id));

        $response->assertRedirect(route('admin.berita.index'));
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseMissing('berita', ['id' => $berita->id]);
        
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_destroy_berita_without_existing_image(): void
    {
        $berita = Berita::factory()->create([
            'kategori_id' => $this->kategori->id,
            'gambar' => 'not-exist-file.jpg',
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.berita.destroy', $berita->id));

        $response->assertRedirect(route('admin.berita.index'));
        
        // SUDAH DIPERBAIKI: Menggunakan 'berita' bukan 'beritas'
        $this->assertDatabaseMissing('berita', ['id' => $berita->id]);
    }
}