<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Patient;
use App\Models\Dokter;
use Carbon\Carbon;

class PeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $keluhanChoices = [
            'Sakit gigi belakang',
            'Ingin dibersihkan karang gigi',
            'Sakit gigi depan',
            'Ingin dicabut',
        ];

        $diagnosaChoices = [
            'Karies',
            'Kalkulus',
            'Gingivitis',
            'Periodontitis',
        ];

        $patients = Patient::select('id')->get();
        $dokterIds = Dokter::pluck('id')->all();

        if ($patients->isEmpty() || empty($dokterIds)) {
            $this->command->warn('Patients atau Dokter kosong. Seed dulu tabelnya.');
            return;
        }

        // Helper: waktu kedatangan normal (Oktober 2024 - Juni 2025)
        $randomDate = function () use ($faker) {
            return $faker->dateTimeBetween('2024-10-01', '2025-09-12');
        };

        // 1) Semua pasien: 1 periksa, status selesai
        foreach ($patients as $p) {
            DB::table('periksa')->insert([
                'patient_id'       => $p->id,
                'dokter_id'        => $faker->randomElement($dokterIds),
                'keluhan'          => $faker->randomElement($keluhanChoices),
                'diagnosa'         => $faker->randomElement($diagnosaChoices),
                'waktu_kedatangan' => $randomDate(),
                'status'           => 'selesai',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // Ambil pasien acak tanpa overlap
        $pool = $patients->pluck('id')->shuffle()->values();

        $jumlah2 = min(20, $pool->count());
        $p20 = $pool->slice(0, $jumlah2);

        $sisa = $pool->slice($jumlah2);
        $jumlah3 = min(13, $sisa->count());
        $p13 = $sisa->slice(0, $jumlah3);

        // 2) Tambahan: 20 pasien -> total 2 periksa
        foreach ($p20 as $pid) {
            DB::table('periksa')->insert([
                'patient_id'       => $pid,
                'dokter_id'        => $faker->randomElement($dokterIds),
                'keluhan'          => $faker->randomElement($keluhanChoices),
                'diagnosa'         => $faker->randomElement($diagnosaChoices),
                'waktu_kedatangan' => $randomDate(),
                'status'           => 'selesai',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // 3) Tambahan: 13 pasien lain -> total 3 periksa
        foreach ($p13 as $pid) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('periksa')->insert([
                    'patient_id'       => $pid,
                    'dokter_id'        => $faker->randomElement($dokterIds),
                    'keluhan'          => $faker->randomElement($keluhanChoices),
                    'diagnosa'         => $faker->randomElement($diagnosaChoices),
                    'waktu_kedatangan' => $randomDate(),
                    'status'           => 'selesai',
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        // 4) Tambahan: 3 pasien acak status 'menunggu' hari ini jam 09:00 - 10:00
        $pToday = $patients->random(min(3, $patients->count()));

        foreach ($pToday as $patient) {
            $randomTime = \Carbon\Carbon::today('Asia/Jakarta')
                ->setHour(9)
                ->setMinute(rand(0, 59))
                ->setSecond(0);

            DB::table('periksa')->insert([
                'patient_id'       => $patient->id, // <— pakai ->id
                'dokter_id'        => 2,
                'keluhan'          => $faker->randomElement($keluhanChoices),
                'diagnosa'         => '',
                'waktu_kedatangan' => $randomTime,
                'status'           => 'menunggu',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

    }
}
