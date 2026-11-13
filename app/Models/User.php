<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'email',
        'no_hp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Inisial nama untuk avatar, contoh "Sita Nurya" jadi "SN". Dipanggil dengan $user->inisial
    public function getInisialAttribute()
    {
        $kata = explode(' ', trim($this->nama_lengkap));
        $inisial = strtoupper(substr($kata[0], 0, 1));

        if (count($kata) > 1) {
            $inisial .= strtoupper(substr($kata[1], 0, 1));
        }

        return $inisial;
    }

    // Relasi: satu user punya banyak reservasi (One-to-Many)
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_user', 'id_user');
    }

    // Relasi: satu user punya banyak ulasan (One-to-Many)
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_user', 'id_user');
    }

    // Relasi: satu user punya banyak notifikasi (One-to-Many)
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id_user');
    }
}
