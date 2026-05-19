<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    
    protected $appends = ['gambar_url'];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the image URL for the news item
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
        
        // Jika path clean (misal: berita/123_judul.jpg), gunakan Storage::url()
        return Storage::url($this->gambar);
    }
}