<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'url_gambar',
        'kategori',
        'lokasi',
        'tanggal_foto',
        'status',
        'views'
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

    /**
     * Get the image URL for the gallery item
     */
    public function getGambarUrlAttribute()
    {
        return $this->belongsTo(Kategori::class);
    }
}