<!-- resources/views/livewire/admin-dashboard.blade.php -->

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        @foreach (['Total Rooms', 'Total Booking', 'Total Users'] as $title)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-neutral-100">{{ $title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">Placeholder content</p>
                </div>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        @endforeach
    </div>

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <h1>Welcome Admin!</h1>
        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
</div>
