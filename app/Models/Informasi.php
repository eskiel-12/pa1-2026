<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Informasi extends Model
{
    protected $table = 'informasi';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori',
        'kategori_id',
        'penulis',
        'status',
        'views',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('images/no-image.png');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        $path = str_replace('public/', '', $this->gambar);
        return asset('uploads/' . ltrim($path, '/'));
    }
}