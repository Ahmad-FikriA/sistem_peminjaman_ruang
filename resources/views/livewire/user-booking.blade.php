<div class="p-6 bg-neutral-950 text-white rounded-2xl shadow space-y-6 min-h-screen">
    <h2 class="text-3xl font-bold">My Bookings</h2>

    @if (session()->has('error'))
        <div class="bg-red-800/20 border border-red-600 text-red-400 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-green-800/20 border border-green-600 text-green-400 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Booking Form -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Room</label>
                <select wire:model="roomId" required class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Select Room --</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                @error('room_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Start Date</label>
                <input type="date" wire:model="startDate" required class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg">
                @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">End Date</label>
                <input type="date" wire:model="endDate" required class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg">
                @error('end_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <input type="hidden" wire:model="status" value="pending">

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition px-5 py-2 rounded-lg text-sm font-medium text-white">
                {{ $bookingId ? 'Update' : 'Create' }} Booking
            </button>
            <button type="button" wire:click="resetInputFields" class="bg-neutral-700 hover:bg-neutral-600 transition px-5 py-2 rounded-lg text-sm text-white">
                Reset
            </button>
        </div>
    </form>

    <!-- Booking Table -->
    <div class="pt-6">
        <h3 class="text-xl font-semibold mb-3">My Booking List</h3>

        <div class="overflow-x-auto rounded-lg shadow border border-neutral-700">
            <table class="min-w-full text-sm text-left text-white bg-neutral-900">
                <thead class="bg-neutral-800 text-neutral-400 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-4 py-3 border border-neutral-700">ID</th>
                        <th class="px-4 py-3 border border-neutral-700">Room</th>
                        <th class="px-4 py-3 border border-neutral-700">Start Date</th>
                        <th class="px-4 py-3 border border-neutral-700">End Date</th>
                        <th class="px-4 py-3 border border-neutral-700">Status</th>
                        <th class="px-4 py-3 border border-neutral-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-neutral-800 border-t border-neutral-700">
                            <td class="px-4 py-3">{{ $booking->id }}</td>
                            <td class="px-4 py-3">{{ $booking->room->name }}</td>
                            <td class="px-4 py-3">{{ $booking->start_date }}</td>
                            <td class="px-4 py-3">{{ $booking->end_date }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $booking->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : ($booking->status === 'approved' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400') }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($booking->status === 'pending')
                                    <div class="flex gap-2">
                                        <button wire:click="edit({{ $booking->id }})"
                                            class="px-3 py-1 text-xs bg-yellow-600 hover:bg-yellow-700 text-white rounded">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $booking->id }})"
                                            onclick="confirm('Hapus booking ini?') || event.stopImmediatePropagation()"
                                            class="px-3 py-1 text-xs bg-red-600 hover:bg-red-700 text-white rounded">
                                            Delete
                                        </button>
                                    </div>
                                @else
                                    <span class="text-neutral-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-neutral-500">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
