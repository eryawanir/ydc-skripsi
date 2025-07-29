<?php

namespace App\Livewire\Manajemen;

use Livewire\Component;
use App\Models\Dokter;
use Livewire\WithPagination;

class KelolaDokter extends Component
{
    use WithPagination;

    public $nama, $jenis_kelamin, $no_sertifikat, $tempat_lahir, $tanggal_lahir, $no_hp, $nik, $alamat, $tipe_dokter;
    public $dokterId = null;
    public $isEdit = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'no_sertifikat' => 'string|max:255',
        'tempat_lahir' => 'string|max:255',
        'tanggal_lahir' => 'date',
        'no_hp' => 'string|max:255',
        'nik' => 'string|max:255',
        'alamat' => 'string',
        'tipe_dokter' => 'integer|min:0|max:255',
    ];

    public function simpan()
    {
        // $this->validate();

        Dokter::updateOrCreate(['id' => $this->dokterId], $this->only([
            'nama', 'jenis_kelamin', 'no_sertifikat', 'tempat_lahir', 'tanggal_lahir',
            'no_hp', 'nik', 'alamat',
        ]));

        $this->resetInput();
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $this->fill($dokter->toArray());
        $this->dokterId = $id;
        $this->isEdit = true;
    }

    public function hapus($id)
    {
        Dokter::findOrFail($id)->delete();
    }

    public function resetInput()
    {
        $this->reset(['nama', 'jenis_kelamin', 'no_sertifikat', 'tempat_lahir', 'tanggal_lahir',
            'no_hp', 'nik', 'alamat', 'tipe_dokter', 'dokterId', 'isEdit']);
    }

    public function render()
    {
        return view('livewire.manajemen.kelola-dokter', [
            'dokters' => Dokter::orderBy('nama')->paginate(10),
        ]);
    }
}
