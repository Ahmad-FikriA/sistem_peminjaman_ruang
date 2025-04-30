<?php

namespace App\Livewire\Admin\Rooms;

use Livewire\Component;

class Edit extends Component
{   
    public $room_id, $name, $description, $location, $capacity, $is_available;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'location' => 'nullable|string|max:255',
        'capacity' => 'required|integer|min:1',
        'is_available' => 'boolean',
    ];
    public function mount($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $this->room_id = $room->id;
        $this->name = $room->name;
        $this->description = $room->description;
        $this->location = $room->location;
        $this->capacity = $room->capacity;
        $this->is_available = $room->is_available;
    }
    public function update()
    {
        $this->validate();

        // Update the room
        $room = \App\Models\Room::findOrFail($this->room_id);
        $room->update([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'is_available' => $this->is_available,
        ]);

        // Reset the form fields
        $this->reset();

        // Optionally, redirect or show a success message
        session()->flash('message', 'Room updated successfully.');
        return redirect()->route('admin.rooms.index');
    }


    public function render()
    {
        return view('livewire.admin.rooms.edit');
    }
}
