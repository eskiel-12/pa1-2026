<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    
    protected $table = 'berita';

    // Tambahkan baris ini agar semua kolom (termasuk 'judul') bisa diisi via create()/update()
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_terbit' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}