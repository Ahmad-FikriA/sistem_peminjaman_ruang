<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportManagement extends Component
{
    public $startDate;
    public $endDate;
    public $roomId;
    public $userId;
    public $bookings = [];
    public $rooms = [];
    public $users = [];

    public function mount()
    {
        // Load rooms and users for the dropdowns
        $this->rooms = Room::all();
        $this->users = User::all();
    }

    public function updated($propertyName)
    {
        // Call the method to fetch bookings whenever a property is updated
        $this->fetchBookings();
    }

    public function fetchBookings()
    {
        // Initialize the query
        $query = Booking::query()->with(['room', 'user']);

        // Filter by date range
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_date', [$this->startDate, $this->endDate]);
        }

        // Filter by room
        if ($this->roomId) {
            $query->where('room_id', $this->roomId);
        }

        // Filter by user
        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        // Get the bookings
        $this->bookings = $query->get();
    }

    public function export()
    {
        return Excel::download(new BookingsExport($this->startDate, $this->endDate, $this->roomId, $this->userId), 'laporan_peminjaman.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.report-management', [
            'bookings' => $this->bookings,
            'rooms' => $this->rooms,
            'users' => $this->users,
        ]);
    }
}
