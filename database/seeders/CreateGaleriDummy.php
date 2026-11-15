<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateGaleriDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // [judul, kategori, lokasi foto di public/]
        $galeri = [
            ['Sentuhan yang merawat',    'Manicure & Pedicure', 'images/galeri-01-manicure.jpg'],
            ['Kilau alami Anda',         'Facial Glow',         'images/galeri-02-facial.jpg'],
            ['Cantik untuk momen istimewa', 'Make Up',          'images/galeri-03-makeup.jpg'],
            ['Sentuhan yang merawat',    'Penataan Rambut',     'images/galeri-04-rambut.jpg'],
            ['Kilau alami Anda',         'Manicure & Pedicure', 'images/galeri-05-manicure.jpg'],
            ['Cantik untuk momen istimewa', 'Facial Glow',      'images/galeri-06-facial.jpg'],
            ['Sentuhan yang merawat',    'Make Up',             'images/galeri-07-makeup.jpg'],
            ['Kilau alami Anda',         'Penataan Rambut',     'images/galeri-08-rambut.jpg'],
            ['Cantik untuk momen istimewa', 'Manicure & Pedicure', 'images/galeri-09-manicure.jpg'],
            ['Ruang yang menenangkan',   'Suasana Salon',       'images/ruang-salon.jpg'],
        ];

        foreach ($galeri as $item) {
            DB::table('galeri')->insert([
                'judul'      => $item[0],
                'kategori'   => $item[1],
                'foto'       => $item[2],
                'status'     => 'tampil',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
