<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_user',
        'id_reservasi',
        'judul',
        'pesan',
        'status',
    ];

    // untuk menghitung notifikasi yang belum dibaca (angka di ikon lonceng)
    public function scopeBelumDibaca($query)
    {
        return $query->where('status', 'belum_dibaca');
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
