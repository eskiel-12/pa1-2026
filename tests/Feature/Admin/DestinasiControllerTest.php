<?php

namespace Tests\Feature\Admin;

use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DestinasiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $tableName;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        
        $this->user = User::factory()->create();
        // Mendapatkan nama tabel yang benar dari model untuk assertion database
        $this->tableName = (new Destinasi())->getTable();
    }

    public function test_index_page(): void
    {
        Destinasi::factory()->count(5)->create();

        $response = $this->actingAs($this->user)->get(route('admin.destinasi.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.destinasi.index');
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.destinasi.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.destinasi.create');
    }

    public function test_store_destinasi_with_image_and_tags(): void
    {
        $file = UploadedFile::fake()->image('destinasi.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.destinasi.store'), [
            'nama' => 'Test Destinasi',
            'deskripsi' => 'Test description',
            'lokasi' => 'Test Location',
            'kategori' => 'Alam',
            'tags' => 'tag1, tag2',
            'gambar' => $file,
            'status' => true,
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'nama' => 'Test Destinasi',
            'slug' => 'test-destinasi',
        ]);
    }

    public function test_store_destinasi_without_image_and_tags(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.destinasi.store'), [
            'nama' => 'Destinasi Minimal',
            'deskripsi' => 'Desc',
            'lokasi' => 'Loc',
            'kategori' => 'Budaya',
            // tanpa tags dan gambar
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'nama' => 'Destinasi Minimal',
        ]);
    }

    public function test_store_validation_fails_without_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.destinasi.store'), [
            'deskripsi' => 'Test description',
            'kategori' => 'Alam',
        ]);

        $response->assertSessionHasErrors(['nama', 'lokasi']);
    }

    public function test_edit_page(): void
    {
        $destinasi = Destinasi::factory()->create();

        $response = $this->actingAs($this->user)->get(route('admin.destinasi.edit', $destinasi->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.destinasi.edit');
    }

    public function test_show_page(): void
    {
        $destinasi = Destinasi::factory()->create();

        $response = $this->actingAs($this->user)->get(route('admin.destinasi.show', $destinasi->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.destinasi.show');
    }

    public function test_update_destinasi_without_image(): void
    {
        $destinasi = Destinasi::factory()->create([
            'nama' => 'Old Name',
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.destinasi.update', $destinasi->id), [
            'nama' => 'New Updated Name',
            'deskripsi' => 'Desc',
            'lokasi' => 'Loc',
            'kategori' => 'Buatan',
            'tags' => 'update1',
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseHas($this->tableName, [
            'id' => $destinasi->id,
            'nama' => 'New Updated Name',
        ]);
    }

    public function test_update_destinasi_with_new_image_deletes_old_storage_image(): void
    {
        $oldImage = UploadedFile::fake()->image('old.jpg');
        $oldImagePath = $oldImage->storeAs('destinasi', 'old.jpg', 'public');

        $destinasi = Destinasi::factory()->create([
            'gambar' => $oldImagePath,
        ]);

        $newImage = UploadedFile::fake()->image('new.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.destinasi.update', $destinasi->id), [
            'nama' => 'Destinasi Gambar Baru',
            'deskripsi' => 'Desc',
            'lokasi' => 'Loc',
            'kategori' => 'Alam',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        Storage::disk('public')->assertMissing($oldImagePath);
    }

    public function test_update_destinasi_with_new_image_deletes_old_public_path_image(): void
    {
        // 1. Buat folder dan file dummy di folder public/ aslinya
        $publicDir = public_path('destinasi_dummy_test');
        if (!is_dir($publicDir)) {
            mkdir($publicDir, 0777, true);
        }
        $publicFilePath = 'destinasi_dummy_test/old-public.txt';
        file_put_contents(public_path($publicFilePath), 'dummy file content');

        $destinasi = Destinasi::factory()->create([
            'gambar' => $publicFilePath,
        ]);

        $newImage = UploadedFile::fake()->image('new.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.destinasi.update', $destinasi->id), [
            'nama' => 'Destinasi Public Fix',
            'deskripsi' => 'Desc',
            'lokasi' => 'Loc',
            'kategori' => 'Alam',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        
        // 2. Pastikan file di public/ ikut terhapus oleh fungsi unlink()
        $this->assertFileDoesNotExist(public_path($publicFilePath));
        
        // Bersihkan folder dummy
        if (is_dir($publicDir)) {
            rmdir($publicDir);
        }
    }

    public function test_destroy_destinasi_with_storage_image(): void
    {
        $image = UploadedFile::fake()->image('delete.jpg');
        $imagePath = $image->storeAs('destinasi', 'delete.jpg', 'public');

        $destinasi = Destinasi::factory()->create([
            'gambar' => $imagePath,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.destinasi.destroy', $destinasi->id));

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseMissing($this->tableName, ['id' => $destinasi->id]);
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_destroy_destinasi_with_public_path_image(): void
    {
        $publicDir = public_path('destinasi_dummy_test_delete');
        if (!is_dir($publicDir)) {
            mkdir($publicDir, 0777, true);
        }
        $publicFilePath = 'destinasi_dummy_test_delete/delete-public.txt';
        file_put_contents(public_path($publicFilePath), 'dummy delete');

        $destinasi = Destinasi::factory()->create([
            'gambar' => $publicFilePath,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.destinasi.destroy', $destinasi->id));

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertFileDoesNotExist(public_path($publicFilePath));
        
        if (is_dir($publicDir)) {
            rmdir($publicDir);
        }
    }

    public function test_destroy_destinasi_without_image(): void
    {
        $destinasi = Destinasi::factory()->create([
            'gambar' => null,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.destinasi.destroy', $destinasi->id));

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseMissing($this->tableName, ['id' => $destinasi->id]);
    }
}