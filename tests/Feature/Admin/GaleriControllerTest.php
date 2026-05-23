<?php

namespace Tests\Feature\Admin;

use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GaleriControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $tableName;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        
        $this->user = User::factory()->create();
        $this->tableName = (new Galeri())->getTable(); // Ambil nama tabel langsung dari model
    }

    public function test_index_page(): void
    {
        Galeri::factory()->count(5)->create([
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'http://dummy/dummy.jpg'
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.galeri.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.galeri.index');
        $response->assertViewHas('galeri');
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.galeri.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.galeri.create');
    }

    public function test_store_galeri_with_full_data(): void
    {
        $file = UploadedFile::fake()->image('galeri.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.galeri.store'), [
            'judul' => 'Test Galeri',
            'deskripsi' => 'Test description',
            'gambar' => $file,
            'lokasi' => 'Test Location',
            'tanggal_foto' => '2026-05-23',
            // SUDAH DIPERBAIKI: Kirim boolean/integer bukan string 'on' agar lolos aturan |boolean
            'status' => 1, 
        ]);

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseHas($this->tableName, [
            'judul' => 'Test Galeri',
            'slug' => 'test-galeri',
            'lokasi' => 'Test Location',
            'tanggal_foto' => '2026-05-23',
            'status' => 1,
        ]);
    }

    public function test_store_galeri_with_minimal_data(): void
    {
        $file = UploadedFile::fake()->image('minimal.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.galeri.store'), [
            'judul' => 'Minimal Galeri',
            'deskripsi' => 'Desc',
            'gambar' => $file,
            // lokasi, tanggal_foto, dan status tidak dikirim
        ]);

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseHas($this->tableName, [
            'judul' => 'Minimal Galeri',
            'tanggal_foto' => null,
            'status' => 0, // default false jika tidak ada
        ]);
    }

    public function test_store_validation_fails_without_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.galeri.store'), [
            'deskripsi' => 'Test description',
            // Tanpa judul dan gambar
        ]);

        $response->assertSessionHasErrors(['judul', 'gambar']);
    }

    public function test_store_duplicate_title_generates_unique_slug(): void
    {
        Galeri::factory()->create([
            'judul' => 'Judul Kembar',
            'slug' => 'judul-kembar',
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'dummy'
        ]);

        $file = UploadedFile::fake()->image('kembar.jpg');
        $response = $this->actingAs($this->user)->post(route('admin.galeri.store'), [
            'judul' => 'Judul Kembar',
            'deskripsi' => 'Deskripsi beda',
            'gambar' => $file,
        ]);

        $response->assertRedirect(route('admin.galeri.index'));
        
        $galeriBaru = Galeri::where('deskripsi', 'Deskripsi beda')->first();
        $this->assertStringContainsString('judul-kembar-', $galeriBaru->slug);
    }

    public function test_edit_page(): void
    {
        $galeri = Galeri::factory()->create([
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'dummy'
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.galeri.edit', $galeri->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.galeri.edit');
    }

    public function test_update_galeri_without_new_image(): void
    {
        $galeri = Galeri::factory()->create([
            'judul' => 'Galeri Lama',
            'slug' => 'galeri-lama',
            'gambar' => 'gambar-lama.jpg',
            'url_gambar' => 'dummy'
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.galeri.update', $galeri->id), [
            'judul' => 'Galeri Lama', // Judul sama, untuk test ignoreId generateSlug
            'deskripsi' => 'Update deskripsi',
            'tanggal_foto' => '2026-06-01',
        ]);

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseHas($this->tableName, [
            'id' => $galeri->id,
            'deskripsi' => 'Update deskripsi',
            'slug' => 'galeri-lama',
            'gambar' => 'gambar-lama.jpg', // Gambar tetap sama
            'tanggal_foto' => '2026-06-01',
        ]);
    }

    public function test_update_galeri_with_new_image_deletes_old(): void
    {
        $oldImage = UploadedFile::fake()->image('old-galeri.jpg');
        $oldImagePath = $oldImage->storeAs('image/galeri', 'old-galeri.jpg', 'public');

        $galeri = Galeri::factory()->create([
            'gambar' => $oldImagePath,
            'url_gambar' => 'dummy'
        ]);

        $newImage = UploadedFile::fake()->image('new-galeri.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.galeri.update', $galeri->id), [
            'judul' => 'Galeri Ganti Gambar',
            'deskripsi' => 'Desc',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.galeri.index'));
        
        // Cek gambar lama dihapus
        Storage::disk('public')->assertMissing($oldImagePath);
        $this->assertDatabaseMissing($this->tableName, [
            'gambar' => $oldImagePath,
        ]);
    }

    public function test_toggle_status_flips_boolean(): void
    {
        $galeri = Galeri::factory()->create([
            'status' => 0,
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'dummy'
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.galeri.toggle-status', $galeri->id));

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseHas($this->tableName, [
            'id' => $galeri->id,
            'status' => 1,
        ]);
    }

    public function test_destroy_galeri_with_existing_image(): void
    {
        $image = UploadedFile::fake()->image('hapus.jpg');
        $imagePath = $image->storeAs('image/galeri', 'hapus.jpg', 'public');

        $galeri = Galeri::factory()->create([
            'gambar' => $imagePath,
            'url_gambar' => 'dummy'
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.galeri.destroy', $galeri->id));

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseMissing($this->tableName, ['id' => $galeri->id]);
        
        // Pastikan fisik terhapus
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_destroy_galeri_without_existing_image(): void
    {
        $galeri = Galeri::factory()->create([
            'gambar' => 'file-gaib.jpg',
            'url_gambar' => 'dummy'
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.galeri.destroy', $galeri->id));

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseMissing($this->tableName, ['id' => $galeri->id]);
    }
}