@props([
    'progress' => 0,
])

@php
    $progress = max(0, min(100, $progress));
    $color = $progress >= 80 ? 'green' : ($progress >= 65 ? 'yellow' : 'red');
@endphp

<div
    x-data="{ display: 0, ready: false }"
    x-init="setTimeout(() => ready = true, 100)"
    x-effect="if (ready) display = {{ $progress }}"
    {{ $attributes }}
>
    <flux:progress x-bind:value="display" color="{{ $color }}" />

    <div class="text-xs text-right text-zinc-500">
        {{ round($progress) }}%
    </div>
</div>