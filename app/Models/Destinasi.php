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
        'url_gambar',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function akomodasis()
    {
        return $this->hasMany(Akomodasi::class, 'destinasi_id');
    }

    public function transportasis()
    {
        return $this->hasMany(Transportasi::class, 'destinasi_id');
    }

    public function umkms()
    {
        return $this->hasMany(Umkm::class, 'destinasi_id');
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

        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }

        // Hapus prefix lama jika ada
        $path = str_replace(['public/', 'storage/', 'uploads/'], '', $this->gambar);
        return asset('uploads/' . ltrim($path, '/'));
    }

}
