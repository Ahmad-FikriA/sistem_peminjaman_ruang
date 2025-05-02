<div class="flex min-h-screen flex-col gap-6 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Create New User</h2>
            <p class="mt-1 text-sm text-gray-400">Add a new user to the system</p>
        </div>
        <a href="{{ route('admin.users.userindex') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-gray-700 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Users
        </a>
    </div>

    <!-- Form -->
    <div class="mx-auto w-full max-w-2xl">
        <form wire:submit.prevent="store" class="space-y-6 rounded-xl bg-gray-800 p-6 shadow-lg">
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
                <div class="mt-1">
                    <input type="text" wire:model="name" id="name"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter user's full name">
                </div>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                <div class="mt-1">
                    <input type="email" wire:model="email" id="email"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter user's email address">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password" id="password"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter user's password">
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm Password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password_confirmation" id="password_confirmation"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Confirm user's password">
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Field -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-200">Role</label>
                <div class="mt-1">
                    <select wire:model="role" id="role"
                            class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select a role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                @error('role')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-6">
                <a href="{{ route('admin.users.userindex') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-700 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
