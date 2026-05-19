<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{

    protected $table = 'destinasi';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'lokasi',
        'kategori',
        'tags',
        'maps',
        'status',
        'views',
        'url_gambar'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
