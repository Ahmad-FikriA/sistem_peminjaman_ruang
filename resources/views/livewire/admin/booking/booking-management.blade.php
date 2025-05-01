<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-4">Booking Management (Admin)</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('message') }}
        </div>
    @endif

    <!-- Booking Form -->
    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block font-semibold mb-1">Room:</label>
            <select wire:model="roomId" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Room --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
            @error('room_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">User:</label>
            <select wire:model="userId" class="w-full border rounded px-3 py-2">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Start Date:</label>
            <input type="date" wire:model="startDate" class="w-full border rounded px-3 py-2" />
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">End Date:</label>
            <input type="date" wire:model="endDate" class="w-full border rounded px-3 py-2" />
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Status:</label>
            <select wire:model="status" class="w-full border rounded px-3 py-2">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- <div class="flex items-end gap-2">
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                {{ $bookingId ? 'Update' : 'Create' }} Booking
            </button>
            <button type="button" wire:click="resetInputFields" class="bg-gray-500 text-black px-4 py-2 rounded hover:bg-gray-600">
                Reset
            </button>
        </div> --}}

    </form>

    <!-- Booking List -->
    <h3 class="text-xl font-semibold mb-2">Booking List</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Room</th>
                    <th class="px-4 py-2 border-b">User</th>
                    <th class="px-4 py-2 border-b">Start Date</th>
                    <th class="px-4 py-2 border-b">End Date</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $booking->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->room->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->start_date }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->end_date }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="px-2 py-1 rounded text-white text-xs
                                {{ $booking->status === 'approved' ? 'bg-green-500' :
                                    ($booking->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <button wire:click="edit({{ $booking->id }})"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </button>
                            <button wire:click="delete({{ $booking->id }})"
                                onclick="confirm('Hapus booking ini?') || event.stopImmediatePropagation()"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
