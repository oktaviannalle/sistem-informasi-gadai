<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nasabah;
use App\Models\BarangGadai;
use App\Models\TransaksiGadai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin Users for Gadai Startech
        $admin = User::firstOrCreate(
            ['email' => 'admin@gadaistartech.com'],
            [
                'name' => 'Admin Gadai Startech',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'oktaviarallee@gmail.com'],
            [
                'name' => 'Oktavia Rallee',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Dummy Nasabah (Sleman / Yogyakarta area)
        $nasabahs = [
            [
                'nama' => 'Budi Santoso',
                'no_ktp' => '3404011205900001',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Kaliurang KM 7.5, Depok, Sleman',
            ],
            [
                'nama' => 'Siti Rahmawati',
                'no_ktp' => '3404024508920002',
                'no_hp' => '082198765432',
                'alamat' => 'Jl. Palagan Tentara Pelajar KM 9, Ngaglik, Sleman',
            ],
            [
                'nama' => 'Agus Prasetyo',
                'no_ktp' => '3404032110880003',
                'no_hp' => '085712344321',
                'alamat' => 'Jl. Solo KM 10, Kalasan, Sleman',
            ],
            [
                'nama' => 'Dewi Lestari',
                'no_ktp' => '3404046003950004',
                'no_hp' => '087855556666',
                'alamat' => 'Jl. Magelang KM 5, Mlati, Sleman',
            ],
        ];

        $createdNasabahs = [];
        foreach ($nasabahs as $data) {
            $createdNasabahs[] = Nasabah::firstOrCreate(['no_ktp' => $data['no_ktp']], $data);
        }

        // 3. Create Barang Gadai
        $barangs = [
            [
                'nasabah_id' => $createdNasabahs[0]->id,
                'nama_barang' => 'Laptop ASUS ROG Strix G15',
                'kategori' => 'Elektronik',
                'taksiran_harga' => 18000000.00,
            ],
            [
                'nasabah_id' => $createdNasabahs[1]->id,
                'nama_barang' => 'iPhone 14 Pro Max 256GB Space Black',
                'kategori' => 'Gadget',
                'taksiran_harga' => 15000000.00,
            ],
            [
                'nasabah_id' => $createdNasabahs[2]->id,
                'nama_barang' => 'Kalung Emas 700 (15 Gram)',
                'kategori' => 'Perhiasan',
                'taksiran_harga' => 13500000.00,
            ],
            [
                'nasabah_id' => $createdNasabahs[3]->id,
                'nama_barang' => 'Sepeda Motor Honda Vario 160 (2023)',
                'kategori' => 'Kendaraan',
                'taksiran_harga' => 22000000.00,
            ],
        ];

        $createdBarangs = [];
        foreach ($barangs as $data) {
            $createdBarangs[] = BarangGadai::create($data);
        }

        // 4. Create Transaksi Gadai Variatif (Aktif, Segera Tempo, Terlambat, Lunas)
        $now = Carbon::now();

        // Transaksi 1: Aktif Normal (Jatuh tempo 30 hari ke depan)
        TransaksiGadai::create([
            'barang_gadai_id' => $createdBarangs[0]->id,
            'admin_id' => $admin->id,
            'tanggal_gadai' => $now->copy()->subDays(5),
            'jumlah_pinjaman' => 12000000.00,
            'bunga_persen' => 5.00,
            'tanggal_jatuh_tempo' => $now->copy()->addDays(25),
            'status' => 'aktif',
        ]);

        // Transaksi 2: Segera Jatuh Tempo (H-3)
        TransaksiGadai::create([
            'barang_gadai_id' => $createdBarangs[1]->id,
            'admin_id' => $admin->id,
            'tanggal_gadai' => $now->copy()->subDays(27),
            'jumlah_pinjaman' => 10000000.00,
            'bunga_persen' => 5.00,
            'tanggal_jatuh_tempo' => $now->copy()->addDays(3),
            'status' => 'aktif',
        ]);

        // Transaksi 3: Terlambat (Jatuh tempo 10 hari yang lalu -> Denda 0.5% per hari)
        TransaksiGadai::create([
            'barang_gadai_id' => $createdBarangs[2]->id,
            'admin_id' => $admin->id,
            'tanggal_gadai' => $now->copy()->subDays(40),
            'jumlah_pinjaman' => 9000000.00,
            'bunga_persen' => 5.00,
            'tanggal_jatuh_tempo' => $now->copy()->subDays(10),
            'status' => 'aktif',
        ]);

        // Transaksi 4: Lunas
        TransaksiGadai::create([
            'barang_gadai_id' => $createdBarangs[3]->id,
            'admin_id' => $admin->id,
            'tanggal_gadai' => $now->copy()->subMonths(2),
            'jumlah_pinjaman' => 15000000.00,
            'bunga_persen' => 5.00,
            'tanggal_jatuh_tempo' => $now->copy()->subMonth(),
            'status' => 'lunas',
        ]);
    }
}
