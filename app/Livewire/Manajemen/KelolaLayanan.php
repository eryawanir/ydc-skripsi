<?php

namespace App\Livewire\Manajemen;

use Livewire\Component;
use App\Models\Layanan;
use Flux\Flux;

class KelolaLayanan extends Component
{
    public $layanans;
    public $nama, $jenis, $persentase_dokter, $harga;
    public $layananId = null;
    public $isEdit = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'jenis' => 'required|string|max:100',
        'harga' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->getLayanans();
    }

    public function getLayanans()
    {
        $this->layanans = Layanan::orderBy('updated_at', 'desc')->get();
    }

    public function getFeeDokter($jenis): string
    {
        $map = [
            'umum' => 40,
            'bedah' => 60,
            'odontologi' => 70,
            'lab' => 55,
        ];

        return isset($map[$jenis]) ? $map[$jenis] . '%' : '-';
    }

    public function simpan()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'jenis' => $this->jenis,
            'harga' => $this->harga,
        ];

        if ($this->isEdit && $this->layananId) {
            Layanan::find($this->layananId)->update($data);
        } else {
            Layanan::create($data);
        }

        $this->resetInput();
        $this->getLayanans();
           Flux::modal('form-layanan')->close();
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $this->layananId = $id;
        $this->nama = $layanan->nama;
        $this->jenis = $layanan->jenis;
        $this->harga = $layanan->harga;
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function confirmHapus($id)
    {
        Layanan::destroy($id);
        $this->getLayanans();
    }

    public function resetInput()
    {
        $this->reset(['nama', 'jenis', 'harga', 'layananId', 'isEdit']);
    }

    public function render()
    {
        return view('livewire.manajemen.kelola-layanan');
    }
}
