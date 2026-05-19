<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'url_gambar',
        'kategori_id',
        'lokasi',
        'tanggal_foto',
        'status',
        'views'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}