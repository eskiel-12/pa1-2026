<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELASI KE BERITA
    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    // RELASI KE INFORMASI
    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }

    // RELASI KE GALERI
    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    // RELASI KE DESTINASI
    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    // RELASI KE UMKM
    public function umkms()
    {
        return $this->hasMany(Umkm::class);
    }

    // RELASI KE BANNERS
    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    // RELASI KE KONTAK
    public function kontak()
    {
        return $this->hasMany(Kontak::class);
    }
}