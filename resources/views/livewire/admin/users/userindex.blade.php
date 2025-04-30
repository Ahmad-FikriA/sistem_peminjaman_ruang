<div class="flex flex-col gap-6 p-6 bg-neutral-950 text-white min-h-screen">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold">User Management</h2>
        <a href="{{ route('admin.users.usercreate') }}"
           class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition duration-300 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            + New User
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($users as $user)
            <div class="bg-neutral-900 rounded-xl p-6 shadow hover:shadow-xl transition duration-300">
                <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                <p class="text-neutral-400">{{ $user->email }}</p>
                <p class="text-sm text-neutral-500 mt-1">Role: 
                    <span class="font-medium text-amber-400">{{ ucfirst($user->role ?? 'User') }}</span>
                </p>
                <div class="flex justify-end mt-4 space-x-4">
                    <a href="{{ route('admin.users.useredit', $user->id) }}"
                       class="text-blue-400 hover:text-blue-600 transition">Edit</a>
                    <button wire:click="delete({{ $user->id }})"
                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                            class="text-red-500 hover:text-red-700 transition">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
