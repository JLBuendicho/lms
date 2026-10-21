{{-- resources/views/components/dual-progress.blade.php --}}
@props([
    'primary' => 0,
    'secondary' => 0,
    'primaryLabel' => 'Progress1',
    'secondaryLabel' => 'Progress2',
])

@php
    $primary = max(0, min(100, $primary));
    $secondary = max(0, min(100, $secondary));

    $primaryIsBack = $primary > $secondary;

    $backVar = $primaryIsBack ? 'p' : 's';
    $backColor = $primaryIsBack ? 'bg-green-500' : 'bg-red-500';
    $frontVar = $primaryIsBack ? 's' : 'p';
    $frontColor = 'bg-blue-600';

    // Back bar only animates when primary is the back bar.
    $backTransition = $primaryIsBack ? 'transition-[width] duration-700 ease-out' : '';

    // Front bar grows with a slight delay when secondary is in front,
    // and shrinks immediately when primary is in front.
    $frontDelay = $primaryIsBack ? 'delay-150' : '';

    // Initial values: when primary < secondary, secondary is static (starts at
    // its final width) and primary starts at secondary's length and shrinks.
    $pStart = $primaryIsBack ? 0 : $secondary;
    $sStart = $primaryIsBack ? 0 : $secondary;
@endphp

<div x-data="{ p: {{ $pStart }}, s: {{ $sStart }}, ready: false }" x-init="setTimeout(() => ready = true, 100)"
    x-effect="if (ready) { s = {{ $secondary }}; p = {{ $primary }} }" {{ $attributes->class('w-full') }}>
    <div role="progressbar" aria-valuemin="0" aria-valuemax="100" x-bind:aria-valuenow="p"
        class="relative h-2 w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-white/10">
        {{-- back bar --}}
        <div class="absolute inset-y-0 left-0 z-0 rounded-full {{ $backColor }} {{ $backTransition }}"
            x-bind:style="`width: ${ {{ $backVar }} }%`"></div>

        {{-- front bar --}}
        <div class="absolute inset-y-0 left-0 z-10 rounded-full {{ $frontColor }} transition-[width] duration-700 {{ $frontDelay }} ease-out"
            x-bind:style="`width: ${ {{ $frontVar }} }%`"></div>
    </div>

    <div class="mt-1 flex justify-between text-xs text-zinc-500">
        @if ($primary > $secondary)
            <span>{{ $secondaryLabel . ' ' .  round($secondary) }}%</span>
            <span>{{ $primaryLabel . ' ' .  round($primary) }}%</span>
        @else
            <span>{{ $primaryLabel . ' ' .  round($primary) }}%</span>
            <span>{{ $secondaryLabel . ' ' .  round($secondary) }}%</span>
        @endif

    </div>
</div>
