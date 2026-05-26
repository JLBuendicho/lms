@php
    $file = $getState() ?? [];
@endphp

@if (!empty($file))
    <div class="flex flex-wrap gap-2">
        @foreach ($file as $key => $value)
            <div>
                <div class="w-xs h-full flex flex-col rounded-xl border border-zinc-100 shadow-sm">
                    <flux:heading name="{{ $value }}" level="3"
                        class="w-full p-2 text-sm font-medium text-gray-700 mb-2 border-b border-zinc-300">
                        {{ $value }}
                    </flux:heading>
                    <div class="w-full h-full flex justify-center items-center p-4">
                        <img src="{{ Storage::disk('public')->url($key) }}" alt="{{ $value }}" class="w-auto">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
