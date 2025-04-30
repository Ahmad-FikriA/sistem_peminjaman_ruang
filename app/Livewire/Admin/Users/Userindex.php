<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class Userindex extends Component
{   
    public $users;
    

    public function render()
    {
        
        return view('livewire.admin.users.userindex');
    }

    public function mount()
    {
        $this->users = \App\Models\User::all();
    }

    public function delete($userId)
    {
        $user = \App\Models\User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }
}
