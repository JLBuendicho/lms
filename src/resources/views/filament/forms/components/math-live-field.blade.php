<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
        init() {
            // Wait a tick to ensure the DOM is ready
            this.$nextTick(() => {
                const mf = this.$refs.mathfield;
                if (mf) {
                    // Force configuration
                    mf.setOptions({
                        defaultMode: 'text',
                        smartMode: true,
                        smartFence: true,
                        mathModeSpace: '\\;',
                    });
    
                    // Explicitly set the initial mode to text
                    mf.mode = 'text';
                    mf.mathModeSpace = '\\;';
                    mf.value = this.state || '';
                    mf.addEventListener('input', (e) => {
                        this.state = e.target.value;
                    });
                }
            });
        }
    }" wire:ignore>
        <math-field x-ref="mathfield"
            class="w-full min-h-12.5 p-2 border border-gray-300 rounded-lg bg-white dark:bg-gray-900 dark:border-gray-700"
            style="
        font-size: 1.25rem; 
        --math-field-font-size: 1.25rem;
        --highlight-text
        "></math-field>
    </div>
</x-dynamic-component>
