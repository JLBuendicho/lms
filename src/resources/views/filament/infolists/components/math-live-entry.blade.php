<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <span class="latex pb-4" data-latex='@json($getState())'>
        {{ $getState() }}
    </span>
</x-dynamic-component>
