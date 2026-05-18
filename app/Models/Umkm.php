<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    // protected $table = 'umkm';   ← remove this line, let Laravel use default 'umkms'
    protected $fillable = ['nama', 'deskripsi', 'gambar', 'lokasi', 'kontak'];
}
