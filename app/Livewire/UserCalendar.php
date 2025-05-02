<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class UserCalendar extends Component
{
    public $rooms;
    public $availableRooms;
    public $selectedDate;
    public $events = [];

    public function mount()
    {
        $this->loadRooms();
        $this->loadEvents();
    }

    public function loadRooms()
    {
        $this->rooms = Room::all();
        $this->checkAvailableRooms();
    }

    public function checkAvailableRooms()
    {
        $this->availableRooms = Room::where('is_available', true)
            ->whereDoesntHave('bookings', function ($query) {
                $query->where('status', '!=', 'cancelled')
                    ->where(function ($q) {
                        $q->where('start_date', '<=', now())
                            ->where('end_date', '>=', now());
                    });
            })
            ->get();
    }

    public function loadEvents()
    {
        $bookings = Booking::with(['room', 'user'])
            ->where('status', '!=', 'cancelled')
            ->get();

        $this->events = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->room->name . ' - ' . $booking->user->name,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'backgroundColor' => $this->getStatusColor($booking->status),
                'borderColor' => $this->getStatusColor($booking->status),
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'status' => $booking->status,
                    'room' => $booking->room->name,
                    'user' => $booking->user->name
                ]
            ];
        })->toArray();
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'pending' => '#f59e0b', // yellow
            'confirmed' => '#10b981', // green
            'cancelled' => '#ef4444', // red
            default => '#6b7280' // gray
        };
    }

    public function render()
    {
        return view('livewire.user-calendar');
    }
} 