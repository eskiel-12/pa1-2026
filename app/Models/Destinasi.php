<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destinasi extends Model
{

    protected $table = 'destinasi';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'lokasi',
        'kategori',
        'tags',
        'maps',
        'status',
        'views',
        'url_gambar'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getGambarUrlAttribute(): string
    {
        if (! $this->gambar) {
            return asset('uploads/del.jpeg');
        }

        $path = $this->gambar;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        if (Str::startsWith($path, '/')) {
            return url($path);
        }

        return asset($path);
    }

}
