<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <span class="latex" data-latex='@json($getState())'>
        {{ $getState() }}
    </span>
</x-dynamic-component>
