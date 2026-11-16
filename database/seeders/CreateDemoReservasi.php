<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateDemoReservasi extends Seeder
{
    /**
     * Data contoh: pelanggan, reservasi 7 hari terakhir, pembayaran, dan ulasan.
     * Dipakai supaya dashboard dan halaman lain tidak kosong saat demo.
     */
    public function run(): void
    {
        // 6 pelanggan contoh
        $daftarNama = [
            ['Sita Nurya', 'sita'],
            ['Nadhilah', 'nadhilah'],
            ['Nazla Shazia', 'nazla'],
            ['Gita Fadilla', 'gita'],
            ['Najla Amira', 'najla'],
            ['Dinda Pitriyadi', 'dinda'],
        ];

        $pelanggan = [];
        foreach ($daftarNama as $i => $p) {
            $pelanggan[] = User::create([
                'username'     => $p[1],
                'nama_lengkap' => $p[0],
                'email'        => $p[1] . '@noona.test',
                'no_hp'        => '08123456' . str_pad($i + 10, 4, '0', STR_PAD_LEFT),
                'password'     => Hash::make('password123'),
                'role'         => 'pelanggan',
            ]);
        }

        $layanan = Layanan::all();

        $komentar = [
            'Suka sekali dengan suasana yang tenang. Perawatan wajahnya teliti, kulit terasa lebih cerah.',
            'Hasil perawatannya rapi dan tahan lama. Terapisnya ramah, tempatnya bersih dan nyaman.',
            'Hasil sesuai harapan. Terima kasih, Noona!',
            'Riasannya natural dan tahan seharian. Staf sangat membantu.',
            'Penataan rambutnya rapi dan sesuai permintaan. Pasti kembali lagi.',
        ];

        $jamList = ['10:00', '11:00', '12:00', '13:00', '15:00'];
        $urut = 0;

        // Dari 6 hari lalu sampai hari ini
        for ($hari = 6; $hari >= 0; $hari--) {
            $tanggal = now()->subDays($hari);
            $jumlah = ($hari == 0) ? 4 : 2 + ($hari % 3);

            for ($k = 0; $k < $jumlah; $k++) {
                $urut++;
                $item = $layanan[$urut % $layanan->count()];

                // Status: hari ini dibuat bervariasi, hari sebelumnya hampir semua selesai
                if ($hari == 0) {
                    $status = ['selesai', 'dikonfirmasi', 'menunggu', 'dibatalkan'][$k];
                } else {
                    $status = ($k == 1 && $hari == 3) ? 'dibatalkan' : 'selesai';
                }

                $reservasi = Reservasi::create([
                    'id_user'           => $pelanggan[$urut % count($pelanggan)]->id_user,
                    'id_layanan'        => $item->id_layanan,
                    'kode_reservasi'    => 'NNA-' . $tanggal->format('ymd') . '-' . str_pad($urut, 3, '0', STR_PAD_LEFT),
                    'tanggal_reservasi' => $tanggal->toDateString(),
                    'jam_reservasi'     => $jamList[$k],
                    'catatan'           => null,
                    'status_reservasi'  => $status,
                ]);

                $this->buatPembayaran($reservasi, $item->harga, $status, $tanggal);

                // Ulasan untuk sebagian reservasi yang sudah selesai
                if ($status == 'selesai' && $hari >= 1 && $urut % 2 == 0) {
                    Ulasan::create([
                        'id_user'        => $reservasi->id_user,
                        'id_reservasi'   => $reservasi->id_reservasi,
                        'rating'         => ($urut % 5 == 0) ? 4 : 5,
                        'komentar'       => $komentar[$urut % count($komentar)],
                        'tanggal_ulasan' => $tanggal->toDateString(),
                        'status'         => ($urut % 7 == 0) ? 'menunggu' : 'tampil',
                    ]);
                }
            }
        }

        // Satu reservasi besok dengan bukti pembayaran yang belum dikonfirmasi admin
        $urut++;
        $besok = now()->addDay();
        $item = $layanan[0];
        $reservasi = Reservasi::create([
            'id_user'           => $pelanggan[0]->id_user,
            'id_layanan'        => $item->id_layanan,
            'kode_reservasi'    => 'NNA-' . $besok->format('ymd') . '-' . str_pad($urut, 3, '0', STR_PAD_LEFT),
            'tanggal_reservasi' => $besok->toDateString(),
            'jam_reservasi'     => '10:00',
            'status_reservasi'  => 'menunggu',
        ]);
        Pembayaran::create([
            'id_reservasi'      => $reservasi->id_reservasi,
            'total_bayar'       => $item->harga,
            'nominal_dp'        => (int) round($item->harga * 0.5),
            'sisa_bayar'        => $item->harga - (int) round($item->harga * 0.5),
            'jenis_pembayaran'  => 'dp',
            'status_pembayaran' => 'menunggu_konfirmasi',
        ]);
    }

    // Membuat data pembayaran sesuai status reservasi
    private function buatPembayaran($reservasi, $harga, $status, $tanggal)
    {
        // Reservasi yang dibatalkan tidak punya pembayaran
        if ($status == 'dibatalkan') {
            return;
        }

        $dp = (int) round($harga * 0.5);

        $data = [
            'id_reservasi' => $reservasi->id_reservasi,
            'total_bayar'  => $harga,
            'nominal_dp'   => $dp,
            'sisa_bayar'   => $harga - $dp,
        ];

        if ($status == 'selesai') {
            $data['jenis_pembayaran']   = 'lunas';
            $data['status_pembayaran']  = 'lunas';
            $data['sisa_bayar']         = 0;
            $data['tanggal_pembayaran'] = $tanggal->copy()->setTime(9, 0);
        } elseif ($status == 'dikonfirmasi') {
            $data['jenis_pembayaran']   = 'dp';
            $data['status_pembayaran']  = 'dp';
            $data['tanggal_pembayaran'] = $tanggal->copy()->setTime(8, 0);
        } else {
            $data['jenis_pembayaran']  = 'dp';
            $data['status_pembayaran'] = 'belum_bayar';
        }

        Pembayaran::create($data);
    }
}
