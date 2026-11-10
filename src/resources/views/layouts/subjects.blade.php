@props(['subjectColor' => 'default', 'subjectName' => ''])

@php
    $colorThemes = [
        'default' => [
            'bg' => 'bg-zinc-100',
            'text' => 'text-zinc-900',
        ],
        'red' => [
            'bg' => 'bg-red-900',
            'text' => 'text-zinc-200',
        ],
        'emerald' => [
            'bg' => 'bg-emerald-900',
            'text' => 'text-slate-200',
        ],
        'blue' => [
            'bg' => 'bg-blue-900',
            'text' => 'text-slate-200',
        ],
        'amber' => [
            'bg' => 'bg-amber-900',
            'text' => 'text-slate-200',
        ],
        'violet' => [
            'bg' => 'bg-violet-900',
            'text' => 'text-slate-200',
        ],
    ];
@endphp

<x-layouts::app>
    <div class="w-full h-full flex flex-col items p-8 gap-4">
        <flux:breadcrumbs>
            {{ $breadCrumbs }}
        </flux:breadcrumbs>
        <flux:card class="{{ $colorThemes[$subjectColor]['bg'] }} shadow-sm">
            <flux:heading size="xl" class="text-5xl {{ $colorThemes[$subjectColor]['text'] }}">{{ $subjectName }}
            </flux:heading>
            <flux:heading size="xl" class="{{ $colorThemes[$subjectColor]['text'] }}">
                {{ 'Instructor: ' . auth()->user()->assignedInstructor()->first()->name }}
            </flux:heading>
        </flux:card>

        {{ $slot }}
    </div>
</x-layouts::app>
