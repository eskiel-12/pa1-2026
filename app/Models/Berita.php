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
        'penulis',
        'tanggal_terbit',
        'status',
        'views',
        'komentar',
        'user_id',
    ];

    protected $casts = [
        'tanggal_terbit' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}