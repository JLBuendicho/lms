@props([
    'heading' => null,
    'variant' => 'default',
    'progress' => 0,
])

<div x-data="{ open: false }"
    {{ $attributes->merge(['class' => 'w-full bg-white rounded-xl border border-zinc-200 p-4 shadow-sm']) }}>
    @if ($variant === 'default')
        <button @click="open = ! open" class="flex w-full items-center justify-between font-medium text-left">
            <span>{{ $heading ?? 'Accordion Header' }}</span>
            <flux:icon.chevron-down x-show="open" />
            <flux:icon.chevron-right x-show="! open" />
        </button>
    @elseif ($variant === 'reverse')
        <button @click="open = ! open" class="flex gap-2 w-full items-center font-medium text-left">
            <flux:icon.chevron-down x-show="open" />
            <flux:icon.chevron-right x-show="! open" />
            <span>{{ $heading ?? 'Accordion Header' }}</span>
        </button>
    @elseif ($variant === 'progress')
        <button @click="open = ! open" class="flex gap-2 w-full items-center font-medium text-left">
            <flux:icon.chevron-down x-show="open" />
            <flux:icon.chevron-right x-show="! open" />
            <div class="grid grid-cols-3 w-full items-center">
                <span class="col-span-2">{{ $heading ?? 'Accordion Header' }}</span>
                <div class="col-span-1">
                    <flux:progress value="{{ $progress }}"
                        color="{{ $progress >= 80 ? 'green' : ($progress >= 65 ? 'yellow' : 'red') }}" />
                    <div class="text-xs text-right text-zinc-500">
                        {{ round($progress) }}%
                    </div>
                </div>
            </div>
        </button>
    @endif

    <div x-show="open" x-collapse x-cloak class="mt-2 flex flex-col gap-2">
        {{ $slot }}
    </div>
</div>
