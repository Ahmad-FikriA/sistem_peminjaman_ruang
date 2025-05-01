<div class="p-6 bg-white shadow rounded-lg space-y-6">
    <h2 class="text-2xl font-bold mb-4">My Bookings</h2>

    @if (session()->has('message'))
        <div class="p-3 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Booking Form -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block font-semibold mb-1">Room:</label>
            <select wire:model="roomId" required class="w-full p-2 border border-gray-300 rounded">
                <option value="">-- Select Room --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
            @error('room_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Start Date:</label>
            <input type="date" wire:model="startDate" required class="w-full p-2 border border-gray-300 rounded">
            @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">End Date:</label>
            <input type="date" wire:model="endDate" required class="w-full p-2 border border-gray-300 rounded">
            @error('end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div class="flex space-x-2">

            <!-- Hidden input for status -->
            <input type="hidden" wire:model="status" value="pending">

            <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                {{ $bookingId ? 'Update' : 'Create' }} Booking
            </button>
            <button type="button" wire:click="resetInputFields" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
                Reset
            </button>
        </div>
    </form>

    <!-- Booking List -->
    <div class="overflow-x-auto">
        <h3 class="text-xl font-semibold mt-6 mb-3">My Booking List</h3>
        <table class="w-full border-collapse bg-white text-left">
            <thead>
                <tr class="bg-gray-100 text-sm text-gray-700">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Room</th>
                    <th class="p-3 border">Start Date</th>
                    <th class="p-3 border">End Date</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $booking->id }}</td>
                        <td class="p-3 border">{{ $booking->room->name }}</td>
                        <td class="p-3 border">{{ $booking->start_date }}</td>
                        <td class="p-3 border">{{ $booking->end_date }}</td>
                        <td class="p-3 border capitalize">{{ $booking->status }}</td>
                        <td class="p-3 border">
                            @if($booking->status === 'pending')
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $booking->id }})"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $booking->id }})"
                                        onclick="confirm('Hapus booking ini?') || event.stopImmediatePropagation()"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
