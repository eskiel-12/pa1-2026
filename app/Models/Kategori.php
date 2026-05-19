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
}