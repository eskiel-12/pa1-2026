<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'lokasi',
        'kontak',
        'kategori_id',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return asset('images/no-image.png');
        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) return $this->gambar;
        $path = str_replace('public/', '', $this->gambar);
        return asset('uploads/' . ltrim($path, '/'));
    }
}
