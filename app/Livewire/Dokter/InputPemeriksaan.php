<?php

namespace App\Livewire\Dokter;

use Livewire\Component;
use App\Models\Periksa;
use App\Models\Tindakan;
use App\Models\Layanan;
use Flux\Flux;

class InputPemeriksaan extends Component
{
    public $periksaId;
    public $periksa;
    public $layanans;
    public $diagnosa = '';
    public $keluhan;
    public $tindakanList = [];

    // modal tindakan
    public $lokasi = '';
    public $layanan_id = null;

    public function mount($periksaId)
    {
        $this->layanans = Layanan::orderBy('nama')->get();
        $this->periksaId = $periksaId;
        $this->periksa = Periksa::with('patient')->findOrFail($periksaId);
        $this->diagnosa = $this->periksa->diagnosa ?? '';

            if ($this->periksa->status !== 'sedang diperiksa') {
        $this->periksa->update(['status' => 'sedang diperiksa']);
    }
    }

public function simpanTindakan()
{
    $this->validate([
        'layanan_id' => 'required|exists:layanan,id',
        'lokasi' => 'required|string|max:255',
    ]);

    $layanan = Layanan::find($this->layanan_id);

    $this->tindakanList[] = [
        'layanan_id' => $layanan->id,
        'nama' => $layanan->nama,
        'harga' => $layanan->harga,
        'lokasi' => $this->lokasi,
    ];


    Flux::modal('tambah-tindakan')->close();
   $this->reset(['layanan_id', 'lokasi']);
$this->dispatch('$refresh');
}

    public function hapusTindakan($id)
    {
        Tindakan::where('id', $id)->where('periksa_id', $this->periksaId)->delete();
    }

public function simpan()
{
    $this->validate([
        'diagnosa' => 'required|string',
    ]);

    foreach ($this->tindakanList as $t) {
        $layanan = Layanan::find($t['layanan_id']);




        Tindakan::create([
            'periksa_id'         => $this->periksa->id,
            'layanan_id'         => $layanan->id,
            'lokasi'             => $t['lokasi'],
        ]);
    }

    $this->periksa->update([
        'diagnosa' => $this->diagnosa,
        'status'   => 'billing',
    ]);

    session()->flash('success', 'Pemeriksaan selesai.');

    return redirect()->route('dokter.patient.daftar-periksa');
}


    public function render()
    {

        return view('livewire.dokter.input-pemeriksaan', [
        'layanans' => $this->layanans,
        'periksa' => $this->periksa,
        'tindakanList' => $this->tindakanList,
    ]);
    }
}
