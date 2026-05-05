@php
    $file = $getState() ?? [];
@endphp

@if (!empty($file))
<div class="flex flex-wrap gap-2">
    @foreach ($file as $key => $value)
        <a href="{{ Storage::disk('public')->url($key) }}"
           target="_blank"
           class="text-primary-900 bg-primary-400 hover:bg-primary-300 dark:text-primary-950 dark:bg-primary-600 dark:hover:bg-primary-500 rounded px-2 py-1 transition">
            {{ $value }}
        </a><br>
    @endforeach
</div>
@endif