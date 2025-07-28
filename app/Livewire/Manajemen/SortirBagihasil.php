<?php

namespace App\Livewire\Manajemen;

use Livewire\Component;
use App\Models\Tindakan;
use App\Models\Dokter;
use Carbon\Carbon;
use Flux\DateRange;
use Illuminate\Support\Collection;

class SortirBagiHasil extends Component
{
   public DateRange $tanggalRange;

    public ?int $dokterId = null;

    public Collection $listDokter;
    public Collection $rekap;

    public int $totalKunjungan = 0;
    public int $totalTindakan = 0;
    public int $totalMasuk = 0;
    public int $totalDokter = 0;
    public int $totalKlinik = 0;

    public function mount()
    {
    $this->tanggalRange = DateRange::thisMonth(); // atau last7Days(), allTime(), custom()
    $this->listDokter = Dokter::orderBy('nama')->get();

        $this->rekap = collect();
    }

    public function render()
    {
        $this->ambilDataRekap();

        return view('livewire.manajemen.sortir-bagihasil');
    }

    public function ambilDataRekap()
    {
    $tindakans = Tindakan::with(['periksa.dokter', 'layanan'])
        ->when($this->tanggalRange->preset()?->value !== 'allTime', function ($query) {
            $query->whereBetween('created_at', [
                $this->tanggalRange->start(),
                $this->tanggalRange->end(),
            ]);
        })
        ->when($this->dokterId, function ($query) {
            $query->whereHas('periksa', fn($q) => $q->where('dokter_id', $this->dokterId));
        })
        ->get();

        // Total ringkasan
        $this->totalTindakan = $tindakans->count();
        $this->totalKunjungan = $tindakans->pluck('periksa_id')->unique()->count();
        $this->totalMasuk = $tindakans->sum('uang_masuk');
        $this->totalDokter = $tindakans->sum('fee_dokter');
        $this->totalKlinik = $tindakans->sum('pendapatan_klinik');

        // Rekap per baris tabel
        $this->rekap = $tindakans->groupBy(function ($t) {
            return optional($t->periksa->dokter)->nama . '|' . optional($t->layanan)->nama;
        })->map(function ($group, $key) {
            [$dokter, $layanan] = explode('|', $key);
            return [
                'dokter' => $dokter,
                'layanan' => $layanan,
                'uang_masuk' => $group->sum('uang_masuk'),
                'fee_dokter' => $group->sum('fee_dokter'),
                'pendapatan_klinik' => $group->sum('pendapatan_klinik'),
            ];
        })->values(); // reset index numerik
    }
}
