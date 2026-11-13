<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';

    protected $fillable = [
        'judul',
        'kategori',
        'foto',
        'status',
    ];

    // untuk foto yang ditampilkan di halaman publik
    public function scopeTampil($query)
    {
        return $query->where('status', 'tampil');
    }
}
