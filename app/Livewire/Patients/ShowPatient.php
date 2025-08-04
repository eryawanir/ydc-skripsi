<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use App\Models\Periksa;
use Livewire\Component;

class ShowPatient extends Component
{
    public $patient;
    public $dokterId;
    public $keluhan;
    public $waktuKedatangan;

    public function mount(Patient $patient){
        $this->patient = $patient;
        $this->waktuKedatangan = now()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i');
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
