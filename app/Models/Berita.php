<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;
    
    protected $table = 'berita';
    
    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'kategori_id', 
        'penulis', 'tanggal_terbit', 'status', 'views', 'komentar'
    ];
    
    protected $casts = [
        'tanggal_terbit' => 'date',
        'status' => 'boolean'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
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