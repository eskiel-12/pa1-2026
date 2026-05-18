<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Informasi extends Model
{
    use HasFactory;
    
    protected $table = 'informasi';
    protected $fillable = ['judul', 'slug', 'konten', 'gambar', 'kategori', 'penulis', 'status', 'views'];

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

        return asset('storage/' . ltrim($path, '/'));
    }
}