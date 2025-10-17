<?php

namespace App\Livewire\Manajemen;

use Livewire\Component;
use App\Models\Dokter;
use Flux\Flux;
use Livewire\WithPagination;

class KelolaDokter extends Component
{
    use WithPagination;

    public $nama, $jenis_kelamin, $no_sertifikat, $tempat_lahir, $tanggal_lahir, $no_hp, $nik, $alamat, $tipe_dokter;
    public $dokterId = null;
    public $isEdit = false;
    public $deletedId;

protected $rules = [
    'nama'           => 'required|string|max:255',
    'jenis_kelamin'  => 'required|in:L,P',
    'no_sertifikat'  => 'required|string|max:255',
    'tempat_lahir'   => 'nullable|string|max:255',
    'tanggal_lahir'  => 'nullable|date',
    'no_hp'          => 'required|string|max:255',
    'nik'            => 'nullable|string|max:255|unique:dokters,nik',
    'alamat'         => 'nullable|string',
    'tipe_dokter'    => 'required|integer|in:1,2', // 1 = SIP, 2 = Non-SIP
];


    public function simpan()
    {
        $this->validate();

         Dokter::updateOrCreate(['id' => $this->dokterId], $this->only([
            'nama', 'jenis_kelamin', 'no_sertifikat', 'tempat_lahir', 'tanggal_lahir',
            'no_hp', 'nik', 'alamat', 'tipe_dokter'
        ]));
        Flux::modal('form-dokter')->close();
        if ($this->isEdit){
            Flux::toast(variant: 'success', text: 'Data Dokter berhasil diubah');
        } else {
            Flux::toast(variant: 'success', text: 'Data Dokter berhasil didaftarkan');
        }

    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $this->fill($dokter->toArray());
        $this->dokterId = $id;
        $this->isEdit = true;
    }

    public function confirmHapus($id){
        $dokter = Dokter::find($id);
        if ($dokter->periksas()->exists()){
            Flux::modal('unallowed-delete-dokter')->show();
        }else {
            $this->deletedId = $id;
            Flux::modal('konfirmasi-hapus-dokter')->show();
        }
    }
    public function delete()
    {
        Dokter::findOrFail($this->deletedId)->delete();
        $this->deletedId = null;
        Flux::modal('konfirmasi-hapus-dokter')->close();
        Flux::toast(variant:'success',text:'Data dokter berhasil dihapus');
    }

    public function resetInput()
    {
        $this->reset(['nama', 'jenis_kelamin', 'no_sertifikat', 'tempat_lahir', 'tanggal_lahir',
            'no_hp', 'nik', 'alamat', 'tipe_dokter', 'dokterId', 'isEdit']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manajemen.kelola-dokter', [
            'dokters' => Dokter::orderBy('nama')->paginate(10),
        ]);
    }
}
