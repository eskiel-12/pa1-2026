<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'lokasi',
        'kategori',
        'kategori_id',
        'tags',
        'maps',
        'status',
        'views',
        'url_gambar'
    ];

    protected $casts = [
        'status' => 'boolean',
        'views' => 'integer',
        'tags' => 'array',
    ];

    public function kategoriRelation()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    protected $appends = ['gambar_url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the image URL for the destination
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
        
        // Jika path dimulai dengan /uploads/, gunakan asset()
        if (str_starts_with($this->gambar, '/uploads/')) {
            return asset($this->gambar);
        }
        
        // Jika path dimulai dengan uploads/, gunakan asset()
        if (str_starts_with($this->gambar, 'uploads/')) {
            return asset($this->gambar);
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
        
        // Jika path clean (misal: destinasi/123_judul.jpg), gunakan Storage::url()
        return Storage::url($this->gambar);
    }

}
