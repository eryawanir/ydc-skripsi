<?php

namespace App\Livewire\Patients;

use App\Models\Periksa;
use Carbon\Carbon;
use Livewire\Component;

class DaftarPeriksaPasien extends Component
{
    public function render()
    {
        $periksas = Periksa::with(['patient', 'dokter'])
        ->where('status', '!=', 'selesai')         // Jangan tampilkan jika sudah bayar
        ->orderBy('waktu_kedatangan', 'asc')     // Urutkan dari waktu kedatangan paling awal
        ->paginate(7);

        return view('livewire.patients.daftar-periksa-pasien', [
            'periksas' => $periksas,
        ]);
    }
}
