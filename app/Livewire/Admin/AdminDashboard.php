<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class AdminDashboard extends Component
{
    public $totalRooms;
    public $totalBookings;
    public $totalUsers;

    public function mount()
    {
        $this->totalRooms = Room::count();
        $this->totalBookings = Booking::count();
        $this->totalUsers = User::count();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
