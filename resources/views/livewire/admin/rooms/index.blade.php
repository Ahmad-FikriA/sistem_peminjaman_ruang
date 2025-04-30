<!-- resources/views/livewire/admin/room/index.blade.php -->
<div class="flex flex-col gap-4">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Room Management</h2>
        <a href="{{ route('admin.rooms.create') }}"
           class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            + New Room
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">Is Available</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($rooms as $index => $room)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $room->name }}</td>
                        <td class="px-6 py-4">{{ $room->description }}</td>
                        <td class="px-6 py-4">{{ $room->location }}</td>
                        <td class="px-6 py-4">{{ $room->capacity }}</td>
                        <td class="px-6 py-4">{{ $room->is_available ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                               <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                               wire:click="delete({{ $room->id }})"
                               class="text-red-600 hover:text-red-800 font-medium transition duration-300">
                           Delete
                       </button>
                       
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
