<div class="flex flex-col gap-6 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Booking Management</h2>
            <p class="mt-1 text-sm text-gray-400">Manage and monitor room bookings</p>
        </div>
    </div>

    @if (session()->has('error'))
        <div class="rounded-lg bg-red-500/10 p-4 text-sm text-red-400">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="rounded-lg bg-green-500/10 p-4 text-sm text-green-400">
            {{ session('message') }}
        </div>
    @endif

    <!-- Booking Form -->
    <div class="rounded-xl bg-gray-800 p-6 shadow-lg">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Room Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-200">Room</label>
                    <select wire:model="roomId" 
                            class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Select Room --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                    @error('room_id') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- User Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-200">User</label>
                    <select wire:model="userId" 
                            class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Start Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-200">Start Date</label>
                    <input type="date" wire:model="startDate" 
                           class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500" />
                    @error('start_date') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-200">End Date</label>
                    <input type="date" wire:model="endDate" 
                           class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500" />
                    @error('end_date') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-200">Status</label>
                    <select wire:model="status" 
                            class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    @error('status') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-4">
                <button type="button" wire:click="resetInputFields"
                        class="inline-flex items-center gap-2 rounded-lg bg-gray-700 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ $bookingId ? 'Update' : 'Create' }} Booking
                </button>
            </div>
        </form>
    </div>

    <!-- Booking List -->
    <div class="rounded-xl bg-gray-800 p-6 shadow-lg">
        <h3 class="mb-4 text-lg font-semibold text-white">Booking List</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-700/50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">{{ $booking->id }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">{{ $booking->room->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">{{ $booking->user->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">{{ $booking->start_date }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-300">{{ $booking->end_date }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    @if($booking->status === 'approved') bg-green-100 text-green-800
                                    @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <button wire:click="edit({{ $booking->id }})"
                                            class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-2.5 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $booking->id }})"
                                            onclick="confirm('Are you sure you want to delete this booking?') || event.stopImmediatePropagation()"
                                            class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-2.5 py-1.5 text-xs font-medium text-white transition-colors hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-400">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

