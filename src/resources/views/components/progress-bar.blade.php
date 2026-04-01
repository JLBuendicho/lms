@php
    $percent = max(0, min(100, $percent ?? 0));
@endphp

<div class="w-full">
    <div class="w-full bg-gray-700 rounded-full h-3 overflow-hidden">
        <div class="bg-primary-500 h-3 rounded-full transition-all"
             style="width: {{ $percent }}%">
        </div>
    </div>

    <div class="text-xs text-gray-300 mt-1">
        {{ number_format($percent, 2) }}%
    </div>
</div>