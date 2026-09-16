@props([
    'progress' => 0,
])

<div {{ $attributes->merge(['class' => '']) }}
    x-data="{ display: 0, target: {{ $progress }} }"
    x-init="setTimeout(() => display = target, 100)"
>
    <flux:progress x-bind:value="display"
        color="{{ $progress >= 80 ? 'green' : ($progress >= 65 ? 'yellow' : 'red') }}" />
    <div class="text-xs text-right text-zinc-500">
        {{ round($progress) }}%
    </div>
</div>