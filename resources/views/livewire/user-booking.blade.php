<div class="p-6 bg-gradient-to-br from-gray-800 to-gray-900 text-white rounded-2xl shadow space-y-6 ">
    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">My Bookings</h2>

    @if (session()->has('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-3 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Booking Form -->
    <form wire:submit.prevent="save" class="space-y-4 bg-gray-800/50 p-6 rounded-xl shadow-lg">
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Room</label>
                <select wire:model="roomId" required class="w-full bg-gray-700/50 border border-gray-600 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    <option value="">-- Select Room --</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                @error('room_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Start Date</label>
                <input type="date" wire:model="startDate" required class="w-full bg-gray-700/50 border border-gray-600 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                @error('start_date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">End Date</label>
                <input type="date" wire:model="endDate" required class="w-full bg-gray-700/50 border border-gray-600 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                @error('end_date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <input type="hidden" wire:model="status" value="pending">

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition px-5 py-2 rounded-lg text-sm font-medium text-white shadow-lg shadow-blue-500/20">
                {{ $bookingId ? 'Update' : 'Create' }} Booking
            </button>
            <button type="button" wire:click="resetInputFields" class="bg-gray-700 hover:bg-gray-600 transition px-5 py-2 rounded-lg text-sm text-white">
                Reset
            </button>
        </div>
    </form>

    <!-- Booking Table -->
    <div class="pt-6">
        <h3 class="text-xl font-semibold mb-3 text-gray-300">My Booking List</h3>

        <div class="overflow-x-auto rounded-xl shadow-lg border border-gray-700">
            <table class="min-w-full text-sm text-left text-white bg-gray-800/50">
                <thead class="bg-gray-700/50 text-gray-300 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-4 py-3 border border-gray-700">ID</th>
                        <th class="px-4 py-3 border border-gray-700">Room</th>
                        <th class="px-4 py-3 border border-gray-700">Start Date</th>
                        <th class="px-4 py-3 border border-gray-700">End Date</th>
                        <th class="px-4 py-3 border border-gray-700">Status</th>
                        <th class="px-4 py-3 border border-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-700/30 border-t border-gray-700 transition duration-150">
                            <td class="px-4 py-3">{{ $booking->id }}</td>
                            <td class="px-4 py-3">{{ $booking->room->name }}</td>
                            <td class="px-4 py-3">{{ $booking->start_date }}</td>
                            <td class="px-4 py-3">{{ $booking->end_date }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $booking->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/20' : 
                                       ($booking->status === 'approved' ? 'bg-green-500/20 text-green-400 border border-green-500/20' : 
                                       'bg-red-500/20 text-red-400 border border-red-500/20') }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($booking->status === 'pending')
                                    <div class="flex gap-2">
                                        <button wire:click="edit({{ $booking->id }})"
                                            class="px-3 py-1 text-xs bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded shadow-lg shadow-yellow-500/20 transition duration-200">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $booking->id }})"
                                            onclick="confirm('Hapus booking ini?') || event.stopImmediatePropagation()"
                                            class="px-3 py-1 text-xs bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded shadow-lg shadow-red-500/20 transition duration-200">
                                            Delete
                                        </button>
                                    </div>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
