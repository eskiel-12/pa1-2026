<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'url_gambar',
        'link',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer',
    ];

    protected $appends = ['gambar_url'];

    /**
     * Get the image URL for the banner
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
        
        // Jika path clean (misal: banner/123_judul.jpg), gunakan Storage::url()
        return Storage::url($this->gambar);
    }
}
