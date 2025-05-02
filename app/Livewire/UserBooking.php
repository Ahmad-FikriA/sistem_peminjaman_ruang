<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserBooking extends Component
{   
    public $bookings, $rooms, $users;
    public $bookingId, $roomId;
    public $startDate, $endDate, $status;

    protected $rules = [
        'roomId' => 'required|exists:rooms,id',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
        'status' => 'required|in:pending,confirmed,cancelled',
    ];

    
    public function mount()
    {   
        $this->status = 'pending';
        $this->rooms = Room::where('is_available', true)->get();
        $this->bookings = Booking::where('user_id', Auth::id())->get();
    }
    public function resetInputFields()
    {
        $this->bookingId = null;
        $this->roomId = null;
        $this->startDate = null;
        $this->endDate = null;
        $this->status = 'pending';
    }
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $this->bookingId = $booking->id;
        $this->roomId = $booking->room_id;
        $this->startDate = $booking->start_date;
        $this->endDate = $booking->end_date;
        $this->status = $booking->status;
    }
    public function save()
    {
        $this->validate();

        // Check if room is available
        $room = Room::find($this->roomId);
        if (!$room || !$room->is_available) {
            session()->flash('error', 'This room is currently unavailable.');
            return;
        }

        // Check if there's a booking conflict for this specific room
        $conflict = Booking::where('room_id', $this->roomId)
            ->where(function ($query) {
                $query->where('start_date', '<=', $this->endDate)
                      ->where('end_date', '>=', $this->startDate);
            })
            ->where('status', '!=', 'cancelled') // Don't consider cancelled bookings
            ->where('status', '!=', 'rejected')  // Don't consider rejected bookings
            ->when($this->bookingId, function ($query) {
                $query->where('id', '!=', $this->bookingId);
            })
            ->exists();

        if ($conflict) {
            session()->flash('error', 'This room is already booked for the selected dates. Please choose different dates or a different room.');
            return;
        }
        
        Booking::updateOrCreate(
            ['id' => $this->bookingId],
            [
                'room_id' => $this->roomId,
                'user_id' => Auth::id(),
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'status' => $this->status,
            ]
        );
        session()->flash('message', $this->bookingId ? 'Booking updated successfully.' : 'Booking created successfully.');
        $this->resetInputFields();
        $this->bookings = Booking::where('user_id', Auth::id())->get();
    }

    public function delete($id)
    {
        Booking::find($id)->delete();
        session()->flash('message', 'Booking deleted successfully.');
    }


    public function render()
    {
        return view('livewire.user-booking');
    }
}
