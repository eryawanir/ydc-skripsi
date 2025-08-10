<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use App\Models\Periksa;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ShowPatient extends Component
{
    public Patient $patient;
    public $dokterId;
    public $keluhan;
    public $waktuKedatangan;

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


    public function mount(Patient $patient){
        $this->patient = $patient;
        $this->waktuKedatangan = now()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i');
        $this->fill(
            $patient->only('nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'no_hp',
                            'nik', 'alamat'),
        );
    }

    public function simpan(){
        $this->validate();
        $this->patient->update($this->only([
            'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'no_hp',
            'nik', 'alamat'
        ]));

        Flux::modal('edit')->close();
        Flux::toast(variant:'success',text:'Your changes have been saved.');
    }

    public function simpanPeriksa()
    {
        $this->validate([
            'dokterId' => 'required|exists:dokters,id',
            'keluhan' => 'required|string|min:3',
            'waktuKedatangan' => 'required'
        ]);

        Periksa::create([
            'patient_id' => $this->patient->id,
            'dokter_id' => $this->dokterId,
            'keluhan' => $this->keluhan,
            'waktu_kedatangan' => $this->waktuKedatangan,
            'status' => 'menunggu',
        ]);

        session()->flash('status', 'Pendaftaran periksa berhasil.');
        return $this->redirectRoute('admin.patient.daftar-periksa', navigate:true);
    }

    public function render()
    {
        return view('livewire.patients.show-patient');
    }
}
