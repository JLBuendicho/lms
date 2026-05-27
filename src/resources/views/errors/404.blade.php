<x-layouts::error>
    <div class="h-screen flex flex-col justify-center items-center">
        <flux:heading size="xl">Page not Found</flux:heading>
        <flux:text size="xl">{{ $exception->getMessage() ?: 'Error 404' }}</flux:text>
        @if (Auth::user())
            <flux:button variant="primary"
                href="{{ Auth::user()->role == 'student' ? route('dashboard') : route('admin.dashboard') }}"
                class="mt-6" wire:navigate>
                Return to Dashboard
            </flux:button>
        @else
            <flux:button variant="primary"
                href="/"
                class="mt=6" wire:navigate>
                Return Home
            </flux:button>
        @endif
    </div>
</x-layouts::error>
