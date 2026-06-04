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
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer',
    ];

    protected $appends = ['gambar_url'];

    /* Get the image URL for the banner */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
