<?php

namespace App\Livewire\Module\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.app')]
class UserCreate extends Component
{

    #[Validate('required|min:3')]
    public $email;
    #[Validate('required|min:3')]
    public $name;

    public function submitUser()
    {
        $this->validate();
        $create = User::Create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('password'),
        ]);

        $userRole = Role::FirstOrCreate(['name' => $this->name]);
        $create->assignRole($userRole);
        session()->flash('success', "L'Utilisateur a été créé avec succès.");
        return redirect()->to(route('user.index'));
    }
    
    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
