<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
        'id_user',
        'id_reservasi',
        'rating',
        'komentar',
        'foto_ulasan',
        'tanggal_ulasan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_ulasan' => 'date',
        ];
    }

    // untuk ulasan yang boleh tampil di halaman publik
    public function scopeTampil($query)
    {
        return $query->where('status', 'tampil');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
