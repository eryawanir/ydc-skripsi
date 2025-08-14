<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreatePatient extends Component
{
    #[Validate('required|regex:/^[a-zA-Z\s.,\']+$/')]
    public $nama_lengkap;

    #[Validate('required|in:L,P')]
    public $jenis_kelamin;

    #[Validate('required')]
    public $tempat_lahir;

    #[Validate('required')]
    public $tanggal_lahir;

    #[Validate('required|regex:/^08\d{8,13}$/')]
    public $no_hp;

    #[Validate('required|regex:/^\d+$/', as: 'NIK')]
    public $nik;

    #[Validate('required')]
    public $alamat;

    public function simpan()
    {
        $this->validate();

        $patient = Patient::create($this->all());
        Flux::toast(variant:'success',text:'Data pasien berhasil didaftarkan');

        session()->flash('status', 'Data pasien berhasil disimpan.');
        return $this->redirectRoute('admin.patient.show', ['patient' => $patient->id], navigate:true);

    }

    public function render()
    {
        return view('livewire.patients.create-patient')->with('title', 'Pendaftaran Pasien Baru');
    }
}
