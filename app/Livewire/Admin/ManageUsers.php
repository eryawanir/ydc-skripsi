<?php

namespace App\Livewire\Admin;

use App\Models\Dokter;
use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public $users;

    public $name;
    public $email;
    public $password;
    public $role;
    public $dokter_id;

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

        $this->resetForm();
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

        $this->formVisible = true;
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
