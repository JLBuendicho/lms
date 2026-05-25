@props([
    'subjectName' => null,
    'assessmentType' => null,
    'question' => null,
    'step' => 1,
    'totalQuestions' => 0,
    'answers' => [],
])

<x-layouts::app>
    <div class="h-full flex flex-col gap-4 justify-center items-center">
        <div class="w-full">
            <flux:heading size="xl" class="text-5xl">
                {{ ucfirst($assessmentType) }} Assessment - {{ ucfirst($subjectName) }}
            </flux:heading>
        </div>
        <form method="POST"
            action="{{ route('assessment.question.store', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => $step]) }}"
            class="h-full w-3/4 grid grid-rows-5 bg-zinc-100 rounded-xl border border-zinc-200 shadow-sm p-6"
            x-data="mathField()" @submit.prevent="submit">

            @csrf

            <div class="row-span-1 w-full flex flex-col gap-4 p-6">
                <flux:progress value="{{ ($step / $totalQuestions) * 100 }}" color="blue" />
                <div class="text-right text-zinc-500">
                    {{ $step }} of {{ $totalQuestions }} Questions
                </div>
            </div>
            <div class="row-span-3 w-full flex flex-col justify-between p-2 overflow-hidden">
                <div class="w-full flex flex-col">
                    <flux:heading size="lg" level="2">
                        Question {{ $step }} ({{ $question->skill->name }}):
                    </flux:heading>
                    <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                        data-latex='@json($question->question)'>
                        {{ $question->question }}
                    </span>
                </div>
                <div class="w-full flex flex-col gap-4">
                    <flux:heading size="lg" level="2">
                        Your Answer:
                    </flux:heading>
                    <math-field id="math-input" x-ref="mathField" @input="onInput" default-mode="text"
                        style="width: 100%; font-size: 1.2rem; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;">{{ $answers[$question->id] ?? '' }}</math-field>

                    <input type="hidden" name="answer" x-model="latex" />

                    @error('answer')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row-span-1 flex gap-2 justify-end items-end px-6">
                @if ($step > 1)
                    <flux:button
                        href="{{ route('assessment.question.show', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => $step - 1]) }}">
                        ← Back
                    </flux:button>
                @endif
                <flux:button type="submit" variant="primary">
                    {{ $step < $totalQuestions ? 'Next →' : 'Submit' }}
                </flux:button>
            </div>
        </form>
        <script>
            function mathField() {
                return {
                    latex: '{{ addslashes($answers[$question->id] ?? '') }}',

                    init() {
                        const mf = this.$refs.mathField;

                        mf.setOptions({
                            defaultMode: 'text',
                            smartMode: true,
                            smartFence: true,
                            mathModeSpace: '\\;',
                        });
                    },

                    onInput(e) {
                        this.latex = e.target.value;
                    },

                    submit() {
                        this.latex = this.$refs.mathField.value;
                        this.$el.submit();
                    }
                }
            }
        </script>
    </div>
</x-layouts::app>
