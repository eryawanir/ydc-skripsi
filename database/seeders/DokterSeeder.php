<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        Dokter::insert([
            [
                'nama' => 'drg. Yustika Dewi',
                'jenis_kelamin' => 'P',
                'no_sertifikat' => 'SIP937801',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-05-12',
                'no_hp' => '081234567890',
                'nik' => '3271010101010001',
                'alamat' => 'Jl. Merdeka No. 10',
                'tipe_dokter' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'drg. Nabela Ulfa',
                'jenis_kelamin' => 'P',
                'no_sertifikat' => 'SIP930002',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1987-08-21',
                'no_hp' => '082345678901',
                'nik' => '3171020202020002',
                'alamat' => 'Jl. Sudirman No. 25',
                'tipe_dokter' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
