<?php

namespace App\Livewire\Admin\Rooms;

use Livewire\Component;

class Create extends Component
{
    public $name, $description, $location, $capacity, $is_available;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'location' => 'nullable|string|max:255',
        'capacity' => 'required|integer|min:1',
        'is_available' => 'boolean',
    ];

    public function store()
    {
        $this->validate();

        // Create a new room
        \App\Models\Room::create([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'is_available' => $this->is_available,
        ]);

        // Reset the form fields
        $this->reset();

        // Optionally, redirect or show a success message
        session()->flash('message', 'Room created successfully.');
        return redirect()->route('admin.rooms.index');
    }


    public function render()
    {
        return view('livewire.admin.rooms.create');
    }
}
