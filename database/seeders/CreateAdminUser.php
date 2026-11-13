<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun admin
        User::create([
            'username'     => 'admin',
            'nama_lengkap' => 'Sita Nurya',
            'email'        => 'admin@noona.test',
            'no_hp'        => '081200000001',
            'password'     => Hash::make('admin12345'),
            'role'         => 'admin',
        ]);

        // Akun pelanggan untuk uji coba
        User::create([
            'username'     => 'pelanggan',
            'nama_lengkap' => 'Nadhilah',
            'email'        => 'pelanggan@noona.test',
            'no_hp'        => '081200000002',
            'password'     => Hash::make('pelanggan123'),
            'role'         => 'pelanggan',
        ]);
    }
}
