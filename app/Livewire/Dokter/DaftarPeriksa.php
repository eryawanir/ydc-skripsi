<?php
namespace App\Livewire\Dokter;

use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DaftarPeriksa extends Component
{
    public function render()
    {
        $dokterId = Auth::user()->dokter_id;
        $namaDokter = Auth::user()->dokter->nama;

        $periksasAktif = Periksa::with('patient')
            ->where('dokter_id', $dokterId)
            ->whereNotIn('status', ['billing', 'selesai'])
            ->orderBy('waktu_kedatangan', 'asc')
            ->get();

        $periksasSelesai = Periksa::with('patient')
            ->where('dokter_id', $dokterId)
            ->whereIn('status', ['billing', 'selesai'])
            ->orderBy('waktu_kedatangan', 'desc')
            ->get();

        return view('livewire.dokter.daftar-periksa', [
            'periksasAktif'   => $periksasAktif,
            'periksasSelesai' => $periksasSelesai,
            'namaDokter' => $namaDokter
        ]);
    }
}
