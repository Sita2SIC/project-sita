<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'nama_layanan',
        'kategori',
        'deskripsi',
        'harga',
        'durasi',
        'foto',
        'status',
    ];

    /**
     * untuk filter data berdasarkan request (dipakai di Kelola Layanan)
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    /**
     * untuk pencarian data dengan LIKE
     */
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }

    // untuk mengambil layanan yang berstatus aktif saja
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Kalau admin sudah upload foto, pakai foto itu. Kalau belum, pakai foto bawaan sesuai kategori.
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }

        $bawaan = [
            'Manicure & Pedicure' => 'layanan-manicure.jpg',
            'Facial Glow'         => 'layanan-facial.jpg',
            'Make Up'             => 'layanan-makeup.jpg',
            'Penataan Rambut'     => 'layanan-rambut.jpg',
        ];

        return asset('images/' . ($bawaan[$this->kategori] ?? 'layanan-facial.jpg'));
    }

    // Relasi: satu layanan dipesan di banyak reservasi 
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_layanan', 'id_layanan');
    }
}
