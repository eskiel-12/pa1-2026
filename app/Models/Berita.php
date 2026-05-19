<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori_id',
        'user_id',
        'penulis',
        'tanggal_terbit',
        'status',
        'views',
        'komentar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}