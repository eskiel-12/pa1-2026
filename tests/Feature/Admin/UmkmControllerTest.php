<?php

namespace Tests\Feature\Admin;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UmkmControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $tableName = 'umkms';

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->user = User::factory()->create();
    }

    public function test_index_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.umkm.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.umkm.index');
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.umkm.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.umkm.create');
    }

    public function test_store_umkm_success(): void
    {
        $file = UploadedFile::fake()->image('umkm.jpg');
        
        $response = $this->actingAs($this->user)->post(route('admin.umkm.store'), [
            'nama' => 'Test UMKM',
            'deskripsi' => 'Test description',
            'lokasi' => 'Test Location',
            'kontak' => '081234567890',
            'gambar' => $file,
        ]);

        $response->assertRedirect(route('admin.umkm.index'));
        $this->assertDatabaseHas($this->tableName, ['nama' => 'Test UMKM']);
    }

    public function test_store_validation_fails(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.umkm.store'), []);
        $response->assertSessionHasErrors(['nama', 'deskripsi', 'lokasi', 'kontak']);
    }

    public function test_edit_page(): void
    {
        $umkm = Umkm::factory()->create();
        $response = $this->actingAs($this->user)->get(route('admin.umkm.edit', $umkm->id));
        $response->assertStatus(200);
    }

    public function test_update_umkm_without_new_image(): void
    {
        $umkm = Umkm::factory()->create(['nama' => 'Old Name']);

        $response = $this->actingAs($this->user)->put(route('admin.umkm.update', $umkm->id), [
            'nama' => 'New Name',
            'deskripsi' => 'New Desc',
            'lokasi' => 'New Loc',
            'kontak' => '123456',
        ]);

        $response->assertRedirect(route('admin.umkm.index'));
        $this->assertDatabaseHas($this->tableName, ['id' => $umkm->id, 'nama' => 'New Name']);
    }

    public function test_update_umkm_with_new_image(): void
    {
        $oldFile = UploadedFile::fake()->image('old.jpg')->store('umkm', 'public');
        $umkm = Umkm::factory()->create(['gambar' => $oldFile]);
        $newFile = UploadedFile::fake()->image('new.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.umkm.update', $umkm->id), [
            'nama' => 'Updated',
            'deskripsi' => 'Desc',
            'lokasi' => 'Loc',
            'kontak' => '123',
            'gambar' => $newFile,
        ]);

        $response->assertRedirect(route('admin.umkm.index'));
        Storage::disk('public')->assertMissing($oldFile);
    }

    public function test_destroy_umkm(): void
    {
        $file = UploadedFile::fake()->image('delete.jpg')->store('umkm', 'public');
        $umkm = Umkm::factory()->create(['gambar' => $file]);

        $response = $this->actingAs($this->user)->delete(route('admin.umkm.destroy', $umkm->id));

        $response->assertRedirect(route('admin.umkm.index'));
        Storage::disk('public')->assertMissing($file);
        $this->assertDatabaseMissing($this->tableName, ['id' => $umkm->id]);
    }
}