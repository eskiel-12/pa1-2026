<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasi';
    protected $fillable = ['judul', 'slug', 'konten', 'gambar', 'kategori', 'penulis', 'status', 'views'];

    protected $appends = ['gambar_url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the image URL for the information item
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
        
        // Jika path clean (misal: informasi/123_judul.jpg), gunakan Storage::url()
        return Storage::url($this->gambar);
    }
}