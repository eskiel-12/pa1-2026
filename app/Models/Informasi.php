<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';

    // TAMBAHKAN INI: Mengizinkan semua kolom diisi secara massal kecuali 'id'
    protected $guarded = ['id'];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('images/no-image.png');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (str_contains($this->gambar, 'public/')) {
            $path = str_replace('public/', '', $this->gambar);
            return Storage::url($path);
        }

        return Storage::url($this->gambar);
    }
}