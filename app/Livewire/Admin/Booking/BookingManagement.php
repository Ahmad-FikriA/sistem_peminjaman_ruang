<?php

namespace App\Livewire\Admin\Booking;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

use Livewire\Component;

class BookingManagement extends Component
{

    public $bookings, $rooms, $users;
    public $bookingId, $roomId, $userId;
    public $startDate, $endDate, $status;

    protected $rules = [
        'roomId' => 'required|exists:rooms,id',
        'userId' => 'required|exists:users,id',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
        'status' => 'required|in:pending,approved,rejected',
    ];

    public function mount()
    {
        $this->bookings = Booking::all();
        $this->rooms = Room::all();
        $this->users = User::all();
    }

    public function resetInputFields()
    {
        $this->bookingId = null;
        $this->roomId = null;
        $this->userId = null;
        $this->startDate = null;
        $this->endDate = null;
        $this->status = 'pending';
    }
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $this->bookingId = $booking->id;
        $this->roomId = $booking->room_id;
        $this->userId = $booking->user_id;
        $this->startDate = $booking->start_date;
        $this->endDate = $booking->end_date;
        $this->status = $booking->status;
    }

    public function save()
    {
        $this->validate();

        // Check if theres a booking conflict
        $conflict = Booking::where('room_id', $this->roomId)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->startDate, $this->endDate])
                      ->orWhereBetween('end_date', [$this->startDate, $this->endDate]);
            })
            ->when($this->bookingId, function ($query) {
                $query->where('id', '!=', $this->bookingId);
            })
            ->exists();
        if ($conflict) {
            session()->flash('error', 'Booking conflict detected. Please choose different dates.');
            return;
        }

        if ($this->bookingId) {
            $booking = Booking::find($this->bookingId);
            $booking->update([
                'room_id' => $this->roomId,
                'user_id' => $this->userId,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'status' => $this->status,
            ]);
            session()->flash('message', 'Booking updated successfully.');
        } else {
            Booking::create([
                'room_id' => $this->roomId,
                'user_id' => $this->userId,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'status' => $this->status,
            ]);
            session()->flash('message', 'Booking saved successfully.');
        }

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Booking::find($id)->delete();
        session()->flash('message', 'Booking deleted successfully.');
    }
    
    public function render()
    {
        return view('livewire.admin.booking.booking-management');
    }
}
