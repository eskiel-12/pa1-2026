<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    
    protected $table = 'berita';
    
    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'kategori_id', 
        'penulis', 'tanggal_terbit', 'status', 'views', 'komentar'
    ];
    
    protected $casts = [
        'tanggal_terbit' => 'date',
        'status' => 'boolean'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}