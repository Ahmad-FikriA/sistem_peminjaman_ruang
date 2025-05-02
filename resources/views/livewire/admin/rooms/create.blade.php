<!-- resources/views/livewire/admin/room/create.blade.php -->
<div class="flex min-h-screen flex-col gap-6  p-6">
    <div class="mx-auto w-full max-w-2xl">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white">Create New Room</h2>
            <p class="mt-1 text-sm text-gray-400">Add a new room to your booking system</p>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="store" class="space-y-6 rounded-xl bg-gray-800 p-6 shadow-lg">
            <!-- Room Name -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Room Name</label>
                <input type="text" wire:model="name"
                       class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Enter room name">
                @error('name') 
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Description</label>
                <textarea wire:model="description"
                          class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                          rows="3"
                          placeholder="Enter room description"></textarea>
                @error('description') 
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Location</label>
                <input type="text" wire:model="location"
                       class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Enter room location">
                @error('location') 
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Capacity -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Capacity</label>
                <input type="number" wire:model="capacity"
                       class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Enter room capacity">
                @error('capacity') 
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability -->
            <div>
                <label class="block text-sm font-medium text-gray-300">Availability</label>
                <select wire:model="is_available"
                        class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-white focus:border-blue-500 focus:ring-blue-500">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
                @error('is_available') 
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.rooms.index') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-700 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Create Room
                </button>
            </div>
        </form>
    </div>
</div>
