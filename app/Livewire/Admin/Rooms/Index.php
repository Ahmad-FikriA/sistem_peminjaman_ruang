<?php

namespace App\Livewire\Admin\Rooms;
use App\Models\Room;

use Livewire\Component;

class Index extends Component
{
    public $rooms;

    public function render()
    {
        $this->rooms = Room::all();
        return view('livewire.admin.rooms.index');
    }

    public function delete($id)
    {
        Room::findOrFail($id)->delete();
        session()->flash('message', 'Room deleted successfully.');
    }
}
