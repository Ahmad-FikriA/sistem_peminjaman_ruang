<div class="flex flex-col gap-6 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Room Booking Calendar</h2>
            <p class="mt-1 text-sm text-gray-400">View and manage room bookings</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                <span class="text-sm text-gray-300">Pending</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                <span class="text-sm text-gray-300">Confirmed</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <span class="text-sm text-gray-300">Cancelled</span>
            </div>
        </div>
    </div>

    <!-- Available Rooms Section -->
    <div class="rounded-xl bg-gray-800 p-6 shadow-lg">
        <h3 class="text-lg font-semibold text-white mb-4">Available Rooms Right Now</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($availableRooms as $room)
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="font-medium text-lg text-white">{{ $room->name }}</h4>
                    <p class="text-gray-400 text-sm">{{ $room->location }}</p>
                    <p class="text-gray-400 text-sm mt-1">Capacity: {{ $room->capacity }} people</p>
                </div>
            @empty
                <p class="text-gray-400">No rooms available at the moment.</p>
            @endforelse
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="rounded-xl bg-gray-800 p-6 shadow-lg">
        <div id="calendar">
            <!-- Calendar content will go here -->
        </div>
    </div>
</div> 