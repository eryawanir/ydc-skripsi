<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class CreatePatient extends Component
{
    public $nama_lengkap;
    public $jenis_kelamin;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $no_hp;
    public $nik;
    public $alamat;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'no_hp' => 'nullable|string|max:15',
        'nik' => 'nullable|string|max:16',
        'alamat' => 'nullable|string',
    ];

    public function simpan()
    {
        $this->validate();

        $patient = Patient::create([
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'no_hp' => $this->no_hp,
            'nik' => $this->nik,
            'alamat' => $this->alamat,
        ]);

        session()->flash('status', 'Data pasien berhasil disimpan.');
        return redirect()->route('admin.patient.show', ['patient' => $patient->id]);

    }

    public function render()
    {
        return view('livewire.patients.create-patient');
    }
}
