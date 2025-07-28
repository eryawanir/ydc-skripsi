<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            ['nama' => 'Tambal Gigi',              'jenis' => 'umum',        'harga' => 150000],
            ['nama' => 'Scaling Gigi',             'jenis' => 'umum',        'harga' => 200000],
            ['nama' => 'Cabut Gigi',               'jenis' => 'bedah',       'harga' => 250000],
            ['nama' => 'Bleaching',                'jenis' => 'odontologi',  'harga' => 350000],
            ['nama' => 'Behel',                    'jenis' => 'odontologi',  'harga' => 800000],
            ['nama' => 'Veneer Gigi',              'jenis' => 'odontologi',  'harga' => 500000],
            ['nama' => 'Perawatan Saluran Akar',   'jenis' => 'bedah',       'harga' => 450000],
            ['nama' => 'Gigi Tiruan',              'jenis' => 'odontologi',  'harga' => 600000],
            ['nama' => 'Rontgen Gigi',             'jenis' => 'lab',         'harga' => 100000],
            ['nama' => 'Konsultasi Dokter Gigi',   'jenis' => 'umum',        'harga' => 50000],
        ];

        DB::table('layanan')->insert($layanans);
    }
}
