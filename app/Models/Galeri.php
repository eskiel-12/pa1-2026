<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'kategori_id',
        'deskripsi',
        'gambar',
        'url_gambar',
        'lokasi',
        'tanggal_foto',
        'status',
        'views'
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('images/no-image.png');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (str_contains($this->gambar, 'public/')) {
            $path = str_replace('public/', '', $this->gambar);
            return Storage::url($path);
        }

        return Storage::url($this->gambar);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}