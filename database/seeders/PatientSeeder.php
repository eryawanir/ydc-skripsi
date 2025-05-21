<?php

namespace Database\Seeders;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'id' => 1,
                'nama_lengkap' => 'Sepawarni',
                'jenis_kelamin' => 'P',
                'umur' => 44,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 3),
                'no_hp' => '081288336186',
                'nik' => null,
                'alamat' => 'Griya Cilengsi 5 A7 No 7'
            ],
            [
                'id' => 2,
                'nama_lengkap' => 'Eti Kusniati',
                'jenis_kelamin' => 'P',
                'umur' => null,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 5),
                'no_hp' => '081219489193',
                'nik' => null,
                'alamat' => ''
            ],
            [
                'id' => 3,
                'nama_lengkap' => 'Aimar Hamizan',
                'jenis_kelamin' => 'L',
                'umur' => 9,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 5),
                'no_hp' => null,
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 4,
                'nama_lengkap' => 'Qonita Shaviyya Az Zahra',
                'jenis_kelamin' => 'P',
                'umur' => 10,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 11),
                'no_hp' => null,
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 5,
                'nama_lengkap' => 'Riesca Setya Permata',
                'jenis_kelamin' => 'P',
                'umur' => 31,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 12),
                'no_hp' => '08568221618',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 6,
                'nama_lengkap' => 'Gathan Azka Diputra',
                'jenis_kelamin' => 'L',
                'umur' => 6,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 16),
                'no_hp' => null,
                'nik' => null,
                'alamat' => 'Perum Merkasari Permai Blok B II A5 RT 01 RW 08'
            ],
            [
                'id' => 7,
                'nama_lengkap' => 'Sarwono',
                'jenis_kelamin' => 'P',
                'umur' => 34,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 16),
                'no_hp' => '085885551808',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 8,
                'nama_lengkap' => 'Wahyu Purnama Putra',
                'jenis_kelamin' => 'L',
                'umur' => 34,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 21),
                'no_hp' => '085697639047',
                'nik' => '3201072103900005',
                'alamat' => 'Perum Merkasari Permai Blok B II A5 RT 01 RW 08'
            ],
            [
                'id' => 9,
                'nama_lengkap' => 'Rahayu Widyaningsih',
                'jenis_kelamin' => 'P',
                'umur' => 35,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 25),
                'no_hp' => '081280851106',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 10,
                'nama_lengkap' => 'Jaya Imam',
                'jenis_kelamin' => 'L',
                'umur' => null,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 27),
                'no_hp' => '081291972453',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 11,
                'nama_lengkap' => 'Emi Widastuti',
                'jenis_kelamin' => 'P',
                'umur' => null,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 11, 27),
                'no_hp' => '082310444545',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 12,
                'nama_lengkap' => 'Hamdandih',
                'jenis_kelamin' => 'L',
                'umur' => 23,
                'tempat_lahir' => 'Temanggung',
                'tanggal_lahir' => Carbon::create(2001, 12, 19),
                'created_at' => Carbon::create(2024, 11, 30),
                'no_hp' => '082179427463',
                'nik' => null,
                'alamat' => 'Gg halim puri harmoni 5 blok A no 4'
            ],
            [
                'id' => 13,
                'nama_lengkap' => 'Hanum Clarissa Wardani',
                'jenis_kelamin' => 'P',
                'umur' => 5,
                'tempat_lahir' => null,
                'tanggal_lahir' => Carbon::create(2019, 9, 9),
                'created_at' => Carbon::create(2024, 12, 2),
                'no_hp' => '081543376942',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5 Blok E 10 no 8'
            ],
            [
                'id' => 14,
                'nama_lengkap' => 'Mauriceka Mellani',
                'jenis_kelamin' => 'P',
                'umur' => 22,
                'tempat_lahir' => 'Wonogiri',
                'tanggal_lahir' => Carbon::create(2002, 6, 21),
                'created_at' => Carbon::create(2024, 12, 2),
                'no_hp' => '085173009676',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5 Blok E 10 no 6'
            ],
            [
                'id' => 15,
                'nama_lengkap' => 'Diska Pramesti',
                'jenis_kelamin' => 'P',
                'umur' => 22,
                'tempat_lahir' => 'Ciamis',
                'tanggal_lahir' => Carbon::create(2002, 9, 4),
                'created_at' => Carbon::create(2024, 12, 5),
                'no_hp' => '081936182375',
                'nik' => '3201074409020002',
                'alamat' => 'Griya Cileungsi 5 Blok E3 no 10'
            ],
            [
                'id' => 16,
                'nama_lengkap' => 'Alip',
                'jenis_kelamin' => 'L',
                'umur' => 22,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'created_at' => Carbon::create(2024, 12, 10),
                'no_hp' => '085714941039',
                'nik' => null,
                'alamat' => 'Griya Cileungsi 5'
            ],
            [
                'id' => 17,
                'nama_lengkap' => 'Ragil Sri Kusumawati',
                'jenis_kelamin' => 'P',
                'umur' => 40,
                'tempat_lahir' => 'Klaten',
                'tanggal_lahir' => Carbon::create(1984, 3, 23),
                'created_at' => Carbon::create(2024, 12, 23),
                'no_hp' => '089506123507',
                'nik' => null,
                'alamat' => ''
            ],
            [
                'id' => 18,
                'nama_lengkap' => 'Muhammad Rizqy Sudiro',
                'jenis_kelamin' => 'L',
                'umur' => 14,
                'tempat_lahir' => 'Bekasi',
                'tanggal_lahir' => Carbon::create(2010, 11, 8),
                'created_at' => Carbon::create(2024, 12, 26),
                'no_hp' => '083896916900',
                'nik' => null,
                'alamat' => 'Perum D\'Sieranz Town Square Blok A5, Desa Gandoang'
            ],
            [
                'id' => 19,
                'nama_lengkap' => 'Maulida Aqilah Shalihah',
                'jenis_kelamin' => 'P',
                'umur' => 7,
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => Carbon::create(2017, 12, 4),
                'created_at' => Carbon::create(2024, 12, 28),
                'no_hp' => '85832471186',
                'nik' => null,
                'alamat' => ''
            ],
            [
                'id' => 20,
                'nama_lengkap' => 'Aura Noviyanti Sudiro',
                'jenis_kelamin' => 'P',
                'umur' => 27,
                'tempat_lahir' => 'Bekasi',
                'tanggal_lahir' => Carbon::create(1997, 11, 5),
                'created_at' => Carbon::create(2024, 12, 29),
                'no_hp' => '81520365376',
                'nik' => null,
                'alamat' => ''
            ],
            [
                'id' => 21,
                'nama_lengkap' => 'Muhammad Nasir',
                'jenis_kelamin' => 'L',
                'umur' => 43,
                'tempat_lahir' => 'Bengkulu',
                'tanggal_lahir' => Carbon::create(1979, 4, 18),
                'created_at' => Carbon::create(2024, 12, 29),
                'no_hp' => '8111344579',
                'nik' => null,
                'alamat' => ''
            ],
        ];

        Patient::insert($patients);

    }
}
