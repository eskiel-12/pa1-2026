<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi'
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'kategori_id');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'kategori_id');
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class, 'kategori_id');
    }

    public function umkms()
    {
        return $this->hasMany(Umkm::class, 'kategori_id');
    }
}