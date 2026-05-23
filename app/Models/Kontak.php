<?php

namespace App\Models;

use Database\Factories\KontakFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'alamat', 'telepon_1', 'telepon_2', 'telepon_3',
        'email_1', 'email_2', 'email_3',
        'jam_buka_kerja', 'jam_tutup_kerja',
        'jam_buka_weekend', 'jam_tutup_weekend',
        'facebook', 'instagram', 'twitter',
        'youtube', 'tiktok', 'maps_url',
    ];

    // Eksplisit arahkan ke factory yang benar
    protected static function newFactory(): KontakFactory
    {
        return KontakFactory::new();
    }
}