@props([
    'heading',
    'file',
    'id' => null
])

<flux:modal.trigger name="{{ $heading . $id ?? '' }}" class="cursor-pointer">
    <div class="w-xs h-full flex flex-col rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:border-zinc-300 transition-all ease-in-out duration-300">
        <flux:heading name="{{ $heading }}" level="3"
            class="w-full p-2 text-sm font-medium text-gray-700 mb-2 border-b border-zinc-300">
            {{ $heading }}
        </flux:heading>
        <div class="w-full h-xs flex justify-center items-center p-4">
            <img src="{{ Storage::disk('public')->url($file) }}" alt="{{ $heading }}" width="150">
        </div>
    </div>
</flux:modal.trigger>

<flux:modal name="{{ $heading . $id ?? '' }}" class="w-screen h-[90vh]">
        <div class="w-full h-full flex justify-center items-center p-4">
            <img src="{{ Storage::disk('public')->url($file) }}" alt="{{ $heading }}" class="w-full">
        </div>
</flux:modal>