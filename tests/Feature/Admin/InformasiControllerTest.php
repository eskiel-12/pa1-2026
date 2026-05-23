<?php

namespace Tests\Feature\Admin;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InformasiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $tableName = 'informasi'; // Pastikan sesuai dengan nama tabel di database kamu

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->user = User::factory()->create();
    }

    public function test_index_page(): void
    {
        Informasi::factory()->count(2)->create();

        $response = $this->actingAs($this->user)->get(route('admin.informasi.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.informasi.index');
        $response->assertViewHas('informasi');
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.informasi.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.informasi.create');
    }

    public function test_store_informasi_without_image(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.informasi.store'), [
            'judul' => 'Test Informasi',
            'konten' => 'Test content',
            'kategori' => 'Budaya',
            'penulis' => 'Test Author',
            'status' => 'on',
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'judul' => 'Test Informasi',
            'status' => 1,
        ]);
    }

    public function test_store_informasi_with_image_and_default_author(): void
    {
        $file = UploadedFile::fake()->image('informasi.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.informasi.store'), [
            'judul' => 'Informasi Bergambar',
            'konten' => 'Test content',
            'kategori' => 'Budaya',
            'gambar' => $file,
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'judul' => 'Informasi Bergambar',
            'penulis' => 'Admin',
            'status' => 0,
        ]);
    }

    public function test_store_informasi_generates_unique_slug_for_duplicates(): void
    {
        Informasi::factory()->create([
            'judul' => 'Judul Kembar',
            'slug' => 'judul-kembar',
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.informasi.store'), [
            'judul' => 'Judul Kembar',
            'konten' => 'Isi beda',
            'kategori' => 'Berita',
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        
        $informasiBaru = Informasi::where('konten', 'Isi beda')->first();
        $this->assertStringContainsString('judul-kembar-', $informasiBaru->slug);
    }

    public function test_store_without_required_fields_fails(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.informasi.store'), [
            'konten' => 'Test content',
        ]);

        $response->assertSessionHasErrors(['judul', 'kategori']);
    }

    public function test_edit_page(): void
    {
        $informasi = Informasi::factory()->create();

        $response = $this->actingAs($this->user)->get(route('admin.informasi.edit', $informasi->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.informasi.edit');
    }

    public function test_update_informasi_without_new_image(): void
    {
        $informasi = Informasi::factory()->create([
            'judul' => 'Info Lama',
            'slug' => 'info-lama',
            'gambar' => 'gambar-lama.jpg'
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.informasi.update', $informasi->id), [
            'judul' => 'Info Lama', 
            'konten' => 'Konten diupdate',
            'kategori' => 'Update Kategori',
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'id' => $informasi->id,
            'konten' => 'Konten diupdate',
            'gambar' => 'gambar-lama.jpg',
            'slug' => 'info-lama'
        ]);
    }

    public function test_update_informasi_with_new_image_deletes_old(): void
    {
        $oldImage = UploadedFile::fake()->image('old-info.jpg');
        $oldImagePath = $oldImage->storeAs('informasi', 'old-info.jpg', 'public');

        $informasi = Informasi::factory()->create(['gambar' => $oldImagePath]);
        $newImage = UploadedFile::fake()->image('new-info.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.informasi.update', $informasi->id), [
            'judul' => 'Info Update Gambar',
            'konten' => 'Konten',
            'kategori' => 'Kat',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        Storage::disk('public')->assertMissing($oldImagePath);
    }

    public function test_destroy_informasi_with_image(): void
    {
        $image = UploadedFile::fake()->image('delete.jpg');
        $imagePath = $image->storeAs('informasi', 'delete.jpg', 'public');

        $informasi = Informasi::factory()->create(['gambar' => $imagePath]);

        $response = $this->actingAs($this->user)->delete(route('admin.informasi.destroy', $informasi->id));

        $response->assertRedirect(route('admin.informasi.index'));
        Storage::disk('public')->assertMissing($imagePath);
    }
}