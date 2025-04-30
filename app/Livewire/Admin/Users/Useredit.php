<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class Useredit extends Component
{   

    public $user, $name, $email, $password, $role;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:user,admin',
    ];
    public function mount($user)
    {
        $this->user = User::findOrFail($user);;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
    }
    public function update()
    {
        $this->validate();

        // Update the user
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password ? bcrypt($this->password) : $this->user->password,
        ]);

        // Reset the form fields
        $this->reset();

        // Optionally, redirect or show a success message
        session()->flash('message', 'User updated successfully.');
        return redirect()->route('admin.users.userindex');
    }

    public function render()
    {
        return view('livewire.admin.users.useredit');
    }
}
