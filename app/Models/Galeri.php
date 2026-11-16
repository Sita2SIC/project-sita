<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    // filter berdasarkan request (dipakai di Kelola Galeri)
    public function scopeFilter(Builder $query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    // pencarian dengan LIKE
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

    // untuk foto yang ditampilkan di halaman publik
    public function scopeTampil($query)
    {
        return $query->where('status', 'tampil');
    }

    // Accessor: dipanggil dengan $galeri->foto_url
    // Foto bawaan (data contoh) disimpan di public/images, foto unggahan admin di storage.
    public function getFotoUrlAttribute()
    {
        if (str_starts_with($this->foto, 'images/')) {
            return asset($this->foto);
        }

        return asset('storage/' . $this->foto);
    }
}
