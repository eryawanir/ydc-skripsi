<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class LevenshteinListPatient extends Component
{
    public string $kataKunci = '';
    public array  $hasil     = [];

    /*  Konstanta algoritma  */
    private const THRESHOLD      = 4; // toleransi salah eja per-kata
    private const PENALTI_GAGAL  = 3; // penalti jika kata input tak punya pasangan ≤ THRESHOLD
    private const PENALTI_SISA   = 1; // penalti per token pasien yang tak terpakai
     private const AMBANG_SKOR   = 5;

    /* ========================== FUNGSI UTIL ========================== */

    /** Normalisasi: huruf kecil, hapus tanda baca, rapikan spasi */
    private function normalize(string $teks): string
    {
        $teks = mb_strtolower($teks);
        $teks = preg_replace('/[^a-z0-9\s]/u', ' ', $teks); // buang selain huruf/angka/spasi
        $teks = preg_replace('/\s+/', ' ', trim($teks));    // spasi jadi satu
        return $teks;
    }

    /** Pecah string jadi array token (per kata) */
    private function tokenisasi(string $teks): array
    {
        return $teks === '' ? [] : explode(' ', $teks);
    }

    /* ============================ LOGIKA ============================ */

    /** Dipanggil ketika tombol / Enter ditekan */
    public function cari(): void
    {
        $inputBersih = $this->normalize($this->kataKunci);
        if ($inputBersih === '') {
            $this->hasil = [];
            return;
        }

        $tokenInput = $this->tokenisasi($inputBersih);

$scored = Patient::query()
    ->select('id', 'nama_lengkap')
    ->get()
    ->map(fn ($p) => $this->hitungSkor($p, $tokenInput))

    /* ——— FILTER BERDASARKAN SKOR ——— */
    ->filter(fn ($row) => $row['skor'] <= self::AMBANG_SKOR)

    /* ——— URUT & LIMIT ——— */
    ->sortBy([
        ['skor', 'asc'],
        ['cocok', 'desc'],
        [fn ($row) => strlen($row['nama']), 'asc'],
    ])
    ->values()
    ->take(20);


        $this->hasil = $scored->toArray();
    }

    /** Hitung skor satu pasien */
    private function hitungSkor(\App\Models\Patient $pasien, array $tokenInput): array
    {
        $tokensPasien = $this->tokenisasi($this->normalize($pasien->nama_lengkap));

        $skor          = 0;
        $tokenTerpakai = [];  // indeks token pasien yang sudah dipakai

        foreach ($tokenInput as $kataIn) {
            // cari jarak terkecil antara kata input & SEMUA kata pasien
            $min = INF;
            $idx = null;

            foreach ($tokensPasien as $i => $tp) {
                $j = levenshtein($kataIn, $tp);
                if ($j < $min) {
                    $min = $j;
                    $idx = $i;
                }
            }

            if ($min <= self::THRESHOLD) {
                $skor += $min;
                $tokenTerpakai[$idx] = true;
            } else {
                $skor += self::PENALTI_GAGAL; // gagal cocok
            }
        }

        // penalti token pasien yang tidak terpakai
        $sisa  = count($tokensPasien) - count($tokenTerpakai);
        $skor += $sisa * self::PENALTI_SISA;

        return [
            'id'    => $pasien->id,
            'nama'  => $pasien->nama_lengkap,
            'skor'  => $skor,
            'cocok' => count($tokenTerpakai), // berapa token input berhasil cocok
        ];
    }


    public function render()
    {
        return view('livewire.patients.levenshtein-list-patient');
    }
}
