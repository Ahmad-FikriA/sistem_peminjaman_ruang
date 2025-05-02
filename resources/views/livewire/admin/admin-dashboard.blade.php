<!-- resources/views/livewire/admin-dashboard.blade.php -->

<div class="flex h-full w-full flex-1 flex-col gap-6 p-6">
    <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <!-- Total Rooms Card -->
        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 shadow-lg transition-all hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-white/90">Total Rooms</h2>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $totalRooms }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.rooms.index') }}" class="text-sm text-white/80 hover:text-white transition-colors">View all rooms →</a>
            </div>
        </div>

        <!-- Total Bookings Card -->
        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-6 shadow-lg transition-all hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-white/90">Total Bookings</h2>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $totalBookings }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.booking') }}" class="text-sm text-white/80 hover:text-white transition-colors">View all bookings →</a>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-6 shadow-lg transition-all hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-white/90">Total Users</h2>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $totalUsers }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.users.userindex') }}" class="text-sm text-white/80 hover:text-white transition-colors">View all users →</a>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="relative mt-6 overflow-hidden rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 p-8 shadow-lg">
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="mt-2 text-gray-400">Here's what's happening with your room booking system today.</p>
        </div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGMwLTIuMjA5IDEuNzkxLTQgNC00czQgMS43OTEgNCA0LTEuNzkxIDQtNCA0LTQtMS43OTEtNC00eiIgZmlsbD0iI2ZmZiIgZmlsbC1vcGFjaXR5PSIuMDUiLz48L2c+PC9zdmc+')] opacity-10"></div>
    </div>
</div>
