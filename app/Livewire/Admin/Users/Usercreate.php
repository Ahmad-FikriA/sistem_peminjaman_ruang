<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class Usercreate extends Component
{   
    public $name, $email, $password, $role;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:user,admin',
    ];
    
    public function store()
    {
        $this->validate();

        // Create a new user
        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);

        // Reset the form fields
        $this->reset();

        // Optionally, redirect or show a success message
        session()->flash('message', 'User created successfully.');
        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.usercreate');
    }
}
