<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateLayananDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            ['Manicure & Pedicure', 'Manicure & Pedicure', 'Perawatan kuku tangan dan kaki oleh perawat profesional.', 180000, 75],
            ['Facial Glow', 'Facial Glow', 'Perawatan wajah untuk kulit bersih, lembap, dan bercahaya.', 250000, 60],
            ['Make Up', 'Make Up', 'Riasan wajah untuk acara spesial sesuai karakter Anda.', 450000, 60],
            ['Penataan Rambut', 'Penataan Rambut', 'Penataan rambut rapi dan nyaman untuk berbagai kesempatan.', 200000, 60],
        ];

        foreach ($layanan as $item) {
            DB::table('layanan')->insert([
                'nama_layanan' => $item[0],
                'kategori'     => $item[1],
                'deskripsi'    => $item[2],
                'harga'        => $item[3],
                'durasi'       => $item[4],
                'status'       => 'aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
