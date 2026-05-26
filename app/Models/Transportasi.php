<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Transportasi extends Model
{
    use HasFactory;

    protected $table = 'transportasis';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'gambar', 'lokasi', 'kontak', 'status', 'user_id'
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return asset('images/no-image.png');
        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) return $this->gambar;
        return Storage::url($this->gambar);
    }
}
