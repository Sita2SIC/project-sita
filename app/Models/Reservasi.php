<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'id_layanan',
        'kode_reservasi',
        'tanggal_reservasi',
        'jam_reservasi',
        'catatan',
        'status_reservasi',
    ];

    // Supaya tanggal_reservasi otomatis jadi objek tanggal
    protected function casts(): array
    {
        return [
            'tanggal_reservasi' => 'date',
        ];
    }

    // Relasi: reservasi dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi: reservasi memesan satu layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    // Relasi: satu reservasi punya satu pembayaran 
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }

    // Relasi: satu reservasi bisa punya satu ulasan
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_reservasi', 'id_reservasi');
    }

    // Relasi: satu reservasi bisa memicu banyak notifikasi 
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_reservasi', 'id_reservasi');
    }
}
