<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BannerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Memalsukan local storage agar file asli tidak menumpuk saat testing
        Storage::fake('public');
        $this->user = User::factory()->create();
    }

    /**
     * Test index page
     */
    public function test_index_page(): void
    {
        Banner::factory()->count(3)->create([
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'http://dummy.com/dummy.jpg'
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.banner.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.index');
    }

    /**
     * Test create page
     */
    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.banner.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.create');
    }

    /**
     * Test store banner
     */
    public function test_store_banner(): void
    {
        $file = UploadedFile::fake()->image('banner.jpg');

        $response = $this->actingAs($this->user)->post(route('admin.banner.store'), [
            'judul' => 'Banner Test',
            'deskripsi' => 'Test Description',
            'gambar' => $file,
            'link' => 'https://example.com',
            'urutan' => 1,
            'status' => true,
        ]);

        $response->assertRedirect(route('admin.banner.index'));
        $this->assertDatabaseHas('banners', [
            'judul' => 'Banner Test',
        ]);
    }

    /**
     * Test store without image
     */
    public function test_store_without_image(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.banner.store'), [
            'judul' => 'Banner Test',
            'deskripsi' => 'Test Description',
        ]);

        $response->assertSessionHasErrors('gambar');
    }

    /**
     * Test show method (kosong di controller)
     */
    public function test_show_method(): void
    {
        $banner = Banner::factory()->create([
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'http://dummy.com/dummy.jpg'
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.banner.show', $banner->id));
        
        $response->assertStatus(200);
    }

    /**
     * Test edit page
     */
    public function test_edit_page(): void
    {
        $banner = Banner::factory()->create([
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'http://dummy.com/dummy.jpg'
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.banner.edit', $banner));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.edit');
    }

    /**
     * Test update banner WITHOUT changing the image
     */
    public function test_update_banner_without_new_image(): void
    {
        $banner = Banner::factory()->create([
            'judul' => 'Old Title',
            'gambar' => 'dummy.jpg',
            'url_gambar' => 'http://dummy.com/dummy.jpg'
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.banner.update', $banner), [
            'judul' => 'New Title Update',
            'deskripsi' => 'New Desc',
            'urutan' => 2,
        ]);

        $response->assertRedirect(route('admin.banner.index'));
        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'judul' => 'New Title Update',
            'gambar' => 'dummy.jpg', // Pastikan gambar lama tidak tertimpa
        ]);
    }

    /**
     * Test update banner WITH new image (Old image should be deleted)
     */
    public function test_update_banner_with_new_image_and_delete_old(): void
    {
        // 1. Buat file fisik palsu agar Storage::exists() bernilai true
        $oldImage = UploadedFile::fake()->image('old.jpg');
        $oldImagePath = $oldImage->store('banner', 'public');

        $banner = Banner::factory()->create([
            'judul' => 'Old Title',
            'gambar' => $oldImagePath,
            'url_gambar' => Storage::url($oldImagePath),
        ]);

        // 2. Siapkan file gambar baru
        $newImage = UploadedFile::fake()->image('new.jpg');

        $response = $this->actingAs($this->user)->put(route('admin.banner.update', $banner), [
            'judul' => 'New Title Update',
            'gambar' => $newImage,
        ]);

        $response->assertRedirect(route('admin.banner.index'));
        
        // 3. Pastikan gambar lama dihapus dari storage fisik
        Storage::disk('public')->assertMissing($oldImagePath);
        
        // 4. Pastikan path gambar di database sudah diganti
        $this->assertDatabaseMissing('banners', [
            'gambar' => $oldImagePath,
        ]);
    }

    /**
     * Test destroy banner and ensure physical file is deleted
     */
    public function test_destroy_banner_with_existing_image(): void
    {
        $image = UploadedFile::fake()->image('banner.jpg');
        $imagePath = $image->store('banner', 'public');

        $banner = Banner::factory()->create([
            'gambar' => $imagePath,
            'url_gambar' => Storage::url($imagePath),
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.banner.destroy', $banner));

        $response->assertRedirect(route('admin.banner.index'));
        $this->assertDatabaseMissing('banners', ['id' => $banner->id]);
        
        // Pastikan file fisik juga ikut terhapus
        Storage::disk('public')->assertMissing($imagePath);
    }

    /**
     * Test destroy banner but the image file is already missing
     */
    public function test_destroy_banner_without_existing_image(): void
    {
        $banner = Banner::factory()->create([
            'gambar' => 'not-exist.jpg',
            'url_gambar' => 'http://dummy.com',
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.banner.destroy', $banner));

        $response->assertRedirect(route('admin.banner.index'));
        $this->assertDatabaseMissing('banners', ['id' => $banner->id]);
    }
}