<!-- resources/views/livewire/admin/room/edit.blade.php -->
<div class="max-w-2xl space-y-6">
    <h2 class="text-xl font-semibold">Edit Room</h2>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Room Name</label>
            <input type="text" wire:model="name"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" wire:model="location"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('location') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Capacity</label>
            <input type="number" wire:model="capacity"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('capacity') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Is Available</label>
            <select wire:model="is_available"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('is_available') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.rooms.index') }}" class="text-sm text-gray-500 hover:underline">Back</a>
            <button type="submit"
                    class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                Update
            </button>
        </div>
    </form>
</div>
