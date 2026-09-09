<x-layouts::app>
    <div class="w-full h-full flex flex-col items p-8 gap-4">
        <flux:breadcrumbs>
            {{ $breadCrumbs }}
        </flux:breadcrumbs>
        <flux:card class="bg-zinc-100 shadow-sm">
            <flux:heading size="xl" class="text-5xl">{{ $subjectName }}</flux:heading>
            <flux:heading size="xl">{{ 'Instructor: ' . auth()->user()->assignedInstructor()->first()->name }}
            </flux:heading>
        </flux:card>

        {{ $slot }}
    </div>
</x-layouts::app>
