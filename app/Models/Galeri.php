<?php
// app/Models/Galeri.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';
    
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'url_gambar',
        'kategori',
        'kategori_id',
        'lokasi',
        'tanggal_foto',
        'status',
        'views',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tanggal_foto' => 'date',
        'views' => 'integer',
    ];

    protected $appends = ['gambar_url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kategoriRelation()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Get the image URL for the gallery item
     */
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('uploads/del.jpeg');
        }
        
        // Jika sudah mengandung http, return as is
        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        
        // Jika path dimulai dengan storage/, gunakan Storage::url()
        if (str_starts_with($this->gambar, 'storage/')) {
            $path = str_replace('storage/', '', $this->gambar);
            return Storage::url($path);
        }
        
        // Jika path dimulai dengan public/, ubah ke storage/
        if (str_starts_with($this->gambar, 'public/')) {
            $path = str_replace('public/', '', $this->gambar);
            return Storage::url($path);
        }
        
        // Jika path clean (misal: image/galeri/123_judul.jpg), gunakan Storage::url()
        return Storage::url($this->gambar);
    }

    // Helper untuk mendapatkan path folder berdasarkan kategori
    public static function getPathByKategori($kategori)
    {
        return match($kategori) {
            'Meat' => 'image/meat/galeri',
            'Batu Bahisan' => 'image/batu-bahisan/galeri',
            'Liang Sipege' => 'image/liang-sipege/galeri',
            default => 'image/galeri',
        };
    }
}