<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class ListPatient extends Component
{
    use WithPagination;

    public $searchKeyword ='';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $patients = Patient::where('nama_lengkap', 'like', '%'. $this->searchKeyword. '%')
                        ->orderBy('created_at', 'desc')
                        ->paginate(7);
        return view('livewire.patients.list-patient', [
            'patients' => $patients,
            'searchKeyowrd' => $this->searchKeyword
        ]);
    }
}
