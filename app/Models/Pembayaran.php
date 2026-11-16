<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_reservasi',
        'total_bayar',
        'nominal_dp',
        'sisa_bayar',
        'jenis_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pembayaran' => 'datetime',
        ];
    }

    // Accessor: jumlah uang yang sudah diterima, dipanggil dengan $pembayaran->diterima
    // Lunas = total tagihan, DP = nominal DP, selain itu belum ada uang masuk
    public function getDiterimaAttribute()
    {
        if ($this->status_pembayaran == 'lunas') {
            return $this->total_bayar;
        }

        if ($this->status_pembayaran == 'dp') {
            return $this->nominal_dp;
        }

        return 0;
    }

    // Relasi: pembayaran milik satu reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
