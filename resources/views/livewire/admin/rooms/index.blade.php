<!-- resources/views/livewire/admin/room/index.blade.php -->
<div class="flex flex-col gap-4">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-200">Room Management</h2>
        <a href="{{ route('admin.rooms.create') }}"
           class="inline-flex items-center rounded-md bg-gray-700 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">
            + New Room
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-600">
        <table class="min-w-full divide-y divide-gray-600">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-300">Is Available</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 bg-gray-900">
                @foreach ($rooms as $index => $room)
                    <tr>
                        <td class="px-6 py-4 text-gray-300">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $room->name }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $room->description }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $room->location }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $room->capacity }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $room->is_available ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}"
                               class="text-blue-400 hover:underline">Edit</a>
                            <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                               wire:click="delete({{ $room->id }})"
                               class="text-red-400 hover:text-red-600 font-medium transition duration-300">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
