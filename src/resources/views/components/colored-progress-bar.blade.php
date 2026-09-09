@props([
    'progress' => 0,
])


<div {{ $attributes->merge(['class' => '']) }}>
    <flux:progress value="{{ $progress }}"
        color="{{ $progress >= 80 ? 'green' : ($progress >= 65 ? 'yellow' : 'red') }}" />
    <div class="text-xs text-right text-zinc-500">
        {{ round($progress) }}%
    </div>
</div>
