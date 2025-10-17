<?php

namespace App\Livewire\Admin;

use App\Models\Dokter;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageUsers extends Component
{
    public $users;

    public $name;
    public $email;
    public $password;
    public $role;
    public $dokter_id;
    public $deletedId;

    public $dokters = [];
    public $editingId = null;
    public $formVisible = false;

    public function mount()
    {
        $this->loadUsers();
        $this->dokters = Dokter::all();
    }

    public function loadUsers()
    {
        $this->users = User::all();
    }

    public function simpan(){
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'role' => 'required|integer',
            'password' => 'required|min:6',
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $this->editingId,
            'role' => 'required|integer',
            'password' => $this->editingId ? 'nullable|min:6' : 'required|min:6',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        User::updateOrCreate(
            ['id' => $this->editingId],
            $data
        );
        if($this->editingId){
            Flux::toast(variant:'success',text:'Data Akun berhasil diedit');
            $this->editingId =null;
        } else{
            Flux::toast(variant:'success',text:'Akun berhasil dibuat');
        }
        $this->resetForm();
        Flux::modal('form-akun')->close();
        $this->loadUsers();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role->value; // jika pakai enum cast
        $this->password = '';

    }
    public function confirmHapus($id){
        $user = User::find($id);
        if ($user->hasPeriksa() || $user->id == Auth::user()->id || $id == 1){
            Flux::modal('unallowed-delete-akun')->show();
        }else {
            $this->deletedId = $id;
            Flux::modal('konfirmasi-hapus-akun')->show();
        }
    }
    public function delete()
    {
        User::findOrFail($this->deletedId)->delete();
        $this->deletedId = null;
        Flux::modal('konfirmasi-hapus-akun')->close();
        Flux::toast(variant:'success',text:'Akun berhasil dihapus');
        $this->mount();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role', 'editingId', 'formVisible']);
    }



    public function render()
    {
        return view('livewire.admin.manage-users');
    }
}
