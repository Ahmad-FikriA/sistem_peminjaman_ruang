<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<div class="flex min-h-screen flex-col gap-6 bg-gray-900 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Password Settings</h2>
            <p class="mt-1 text-sm text-gray-400">Update your account password</p>
        </div>
    </div>

    <!-- Password Form -->
    <div class="mx-auto w-full max-w-2xl">
        <form wire:submit.prevent="updatePassword" class="space-y-6 rounded-xl bg-gray-800 p-6 shadow-lg">
            <!-- Current Password Field -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-200">Current password</label>
                <div class="mt-1">
                    <input type="password" wire:model="current_password" id="current_password"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter your current password">
                </div>
                @error('current_password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">New password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password" id="password"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter your new password">
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password Field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm new password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password_confirmation" id="password_confirmation"
                           class="block w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Confirm your new password">
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Requirements -->
            <div class="rounded-lg bg-gray-700/50 p-4">
                <h4 class="text-sm font-medium text-gray-200">Password requirements:</h4>
                <ul class="mt-2 space-y-1 text-sm text-gray-400">
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        At least 8 characters long
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Contains at least one uppercase letter
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Contains at least one number
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Contains at least one special character
                    </li>
                </ul>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-6">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
