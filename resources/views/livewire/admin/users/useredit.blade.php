<div class="max-w-2xl mx-auto p-6 bg-neutral-900 rounded-xl shadow-lg text-white">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form wire:submit.prevent="update" class="space-y-6">
        <div>
            <label class="block mb-1 text-sm font-medium">Name</label>
            <input type="text" wire:model.defer="name"
                   class="w-full rounded-lg bg-neutral-800 text-white border border-neutral-700 focus:ring-blue-500 focus:border-blue-500"/>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Email</label>
            <input type="email" wire:model.defer="email"
                   class="w-full rounded-lg bg-neutral-800 text-white border border-neutral-700 focus:ring-blue-500 focus:border-blue-500"/>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Role</label>
            <select wire:model.defer="role"
                    class="w-full rounded-lg bg-neutral-800 text-white border border-neutral-700 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.users.userindex') }}" class="text-neutral-400 hover:text-neutral-200">Cancel</a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                Update
            </button>
        </div>
    </form>
</div>
