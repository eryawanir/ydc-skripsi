<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Periksa;
use App\Models\Layanan;
use Carbon\Carbon;

class TindakanSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = Layanan::select('id', 'harga', 'jenis')->get();

        if ($layanans->isEmpty()) {
            $this->command->warn('Tabel layanan kosong. Seed layanan dulu.');
            return;
        }

        $lokasiChoices = ['rahang atas', 'rahang bawah', 'gigi 14', 'gigi 7', 'gigi 10', 'gigi 12'];

        $persen = function (string $jenis): float {
            $j = strtolower($jenis);
            if (str_starts_with($j, 'umum'))  return 0.40;
            if (str_starts_with($j, 'bedah')) return 0.60;
            if (str_starts_with($j, 'odon'))  return 0.70;
            if (str_starts_with($j, 'lab'))   return 0.55;
            return 0.40;
        };

        Periksa::where('status', 'selesai')
            ->select(['id', 'waktu_kedatangan'])
            ->orderBy('id')
            ->chunkById(500, function ($batch) use ($layanans, $lokasiChoices, $persen) {
                $rows = [];

                foreach ($batch as $periksa) {
                    $n = random_int(1, 3);
                    $pick = $layanans->shuffle()->take(min($n, $layanans->count()));

                    // samakan timestamp tindakan dengan waktu_kedatangan periksa
                    $stamp = $periksa->waktu_kedatangan instanceof Carbon
                        ? $periksa->waktu_kedatangan
                        : Carbon::parse($periksa->waktu_kedatangan);

                    foreach ($pick as $layanan) {
                        $harga     = (float) $layanan->harga;
                        $p         = $persen((string) $layanan->jenis);
                        $feeDokter = round($harga * $p, 2);
                        $feeKlinik = round($harga - $feeDokter, 2);

                        $rows[] = [
                            'periksa_id'        => $periksa->id,
                            'layanan_id'        => $layanan->id,
                            'lokasi'            => Arr::random($lokasiChoices),
                            'uang_masuk'        => $harga,
                            'fee_dokter'        => $feeDokter,
                            'pendapatan_klinik' => $feeKlinik,
                            'created_at'        => $stamp, // = waktu_kedatangan
                            'updated_at'        => $stamp, // = waktu_kedatangan
                        ];
                    }
                }

                if ($rows) {
                    DB::table('tindakan')->insert($rows);
                }
            });

        $this->command->info('TindakanSeeder: created_at & updated_at disamakan dengan waktu_kedatangan periksa.');
    }
}
