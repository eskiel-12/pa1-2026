<?php

namespace Tests\Unit;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\Kategori;
use App\Models\Kontak;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_banner_gambar_url_accessor_returns_expected_urls(): void
    {
        $banner = Banner::factory()->make(['gambar' => null]);
        $this->assertSame(asset('uploads/del.jpeg'), $banner->gambar_url);

        $banner->gambar = 'http://example.com/banner.jpg';
        $this->assertSame('http://example.com/banner.jpg', $banner->gambar_url);

        $banner->gambar = 'storage/banner.jpg';
        $this->assertSame(Storage::url('banner.jpg'), $banner->gambar_url);

        $banner->gambar = 'public/banner.jpg';
        $this->assertSame(Storage::url('banner.jpg'), $banner->gambar_url);

        $banner->gambar = 'banner/banner.jpg';
        $this->assertSame(Storage::url('banner/banner.jpg'), $banner->gambar_url);
    }

    public function test_destinasi_route_key_name_and_gambar_url_accessor(): void
    {
        $destinasi = Destinasi::factory()->make(['slug' => 'my-destinasi', 'gambar' => null]);
        $this->assertSame('slug', $destinasi->getRouteKeyName());
        $this->assertSame(asset('uploads/del.jpeg'), $destinasi->gambar_url);

        $destinasi->gambar = 'http://example.com/destinasi.jpg';
        $this->assertSame('http://example.com/destinasi.jpg', $destinasi->gambar_url);

        $destinasi->gambar = '/uploads/destinasi.jpg';
        $this->assertSame(asset('/uploads/destinasi.jpg'), $destinasi->gambar_url);

        $destinasi->gambar = 'uploads/destinasi.jpg';
        $this->assertSame(asset('uploads/destinasi.jpg'), $destinasi->gambar_url);

        $destinasi->gambar = 'storage/destinasi.jpg';
        $this->assertSame(Storage::url('destinasi.jpg'), $destinasi->gambar_url);

        $destinasi->gambar = 'public/destinasi.jpg';
        $this->assertSame(Storage::url('destinasi.jpg'), $destinasi->gambar_url);

        $destinasi->gambar = 'destinasi/destinasi.jpg';
        $this->assertSame(Storage::url('destinasi/destinasi.jpg'), $destinasi->gambar_url);
    }

    public function test_galeri_gambar_url_accessor_handles_empty_url_and_storage_paths(): void
    {
        $galeri = Galeri::factory()->make(['gambar' => null]);
        $this->assertSame(asset('images/no-image.png'), $galeri->gambar_url);

        $galeri->gambar = 'http://example.com/galeri.jpg';
        $this->assertSame('http://example.com/galeri.jpg', $galeri->gambar_url);

        $galeri->gambar = 'public/galeri.jpg';
        $this->assertSame(Storage::url('galeri.jpg'), $galeri->gambar_url);

        $galeri->gambar = 'galeri/galeri.jpg';
        $this->assertSame(Storage::url('galeri/galeri.jpg'), $galeri->gambar_url);
    }

    public function test_informasi_gambar_url_accessor_handles_empty_url_and_public_paths(): void
    {
        $informasi = Informasi::factory()->make(['gambar' => null]);
        $this->assertSame(asset('images/no-image.png'), $informasi->gambar_url);

        $informasi->gambar = 'http://example.com/info.jpg';
        $this->assertSame('http://example.com/info.jpg', $informasi->gambar_url);

        $informasi->gambar = 'public/info.jpg';
        $this->assertSame(Storage::url('info.jpg'), $informasi->gambar_url);

        $informasi->gambar = 'info/info.jpg';
        $this->assertSame(Storage::url('info/info.jpg'), $informasi->gambar_url);
    }

    public function test_berita_belongs_to_kategori_relation(): void
    {
        $relation = (new Berita())->kategori();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertSame(Kategori::class, $relation->getRelated()::class);
    }

    public function test_kategori_has_many_relations(): void
    {
        $kategori = new Kategori();
        $this->assertInstanceOf(HasMany::class, $kategori->destinasi());
        $this->assertInstanceOf(HasMany::class, $kategori->informasi());
        $this->assertInstanceOf(HasMany::class, $kategori->umkms());
    }

    public function test_umkm_belongs_to_kategori_relation(): void
    {
        $relation = (new Umkm())->kategori();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertSame(Kategori::class, $relation->getRelated()::class);
    }

    public function test_user_has_many_relations_for_berita_and_informasi(): void
    {
        $user = new User();
        $this->assertInstanceOf(HasMany::class, $user->berita());
        $this->assertInstanceOf(HasMany::class, $user->informasi());
    }

    public function test_kontak_factory_is_available(): void
    {
        $kontak = Kontak::factory()->create();
        $this->assertDatabaseHas('kontak', ['id' => $kontak->id]);
    }
}
