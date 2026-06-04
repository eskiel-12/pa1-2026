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
        'deskripsi',
        'gambar',
        'url_gambar',
        'lokasi',
        'tanggal_foto',
        'status',
        'views',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ACCESSOR URL GAMBAR
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('images/no-image.png');
        }

        // jika sudah URL lengkap
        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        // Hapus prefix 'public/' jika ada (data lama)
        $path = str_replace('public/', '', $this->gambar);

        return asset('uploads/' . ltrim($path, '/'));
    }
}