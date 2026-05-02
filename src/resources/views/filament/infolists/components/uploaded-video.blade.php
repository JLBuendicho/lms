@php
    $url = $getState()
        ? Storage::disk('public')->url($getState())
        : null;
@endphp

@if ($url)
    <video controls class="w-full rounded-xl shadow">
        <source src="{{ $url }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@else
    <p class="text-sm text-gray-500">No video uploaded.</p>
@endif