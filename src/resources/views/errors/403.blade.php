@props([
    'exception' => null
])

<x-layouts::error>
    <div class="h-screen flex flex-col justify-center items-center">
        <flux:heading size="xl">Access Denied</flux:heading>
        @if ($exception)
            <flux:text size="xl">{{ $exception->getMessage() ?: 'You do not have permission to access this page.' }}</flux:text>
        @else
            <flux:text size="xl">You do not have permission to access this page.</flux:text>
        @endif
        <flux:button variant="primary" href="{{ Auth::user()->role == 'student' ? route('dashboard') : route('admin.dashboard') }}" class="mt-6" wire:navigate>
            Return to Dashboard
        </flux:button>
    </div>
</x-layouts::error>
