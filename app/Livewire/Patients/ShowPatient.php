<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class ShowPatient extends Component
{
    public $patient;

    public function mount(Patient $patient){
        $this->patient = $patient;
    }

    public function render()
    {
        return view('livewire.patients.show-patient');
    }
}
