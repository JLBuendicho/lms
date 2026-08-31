@props([
    'subjectName' => null,
    'assessmentType' => null,
    'question' => null,
    'step' => 1,
    'totalQuestions' => 0,
    'answers' => [],
])
<x-layouts::app>
    <div class="h-full flex flex-col gap-4 justify-center items-center p-8">
        <div class="w-full">
            <flux:heading size="xl" class="text-5xl">
                {{ ucfirst($assessmentType) }} Assessment - {{ ucfirst($subjectName) }}
            </flux:heading>
        </div>
        <form method="POST"
            action="{{ route('assessment.question.store', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => $step]) }}"
            class="h-full w-3/4 grid grid-rows-[10%, 80%, 10%] bg-zinc-100 rounded-xl border border-zinc-200 shadow-sm px-4 pb-1 pt-4"
            x-data="answerField()" @submit.prevent="submit">
            @csrf
            <div class="row-span-1 w-full flex flex-col gap-4 py-2">
                <flux:progress value="{{ ($step / $totalQuestions) * 100 }}" color="blue" />
                <div class="text-right text-zinc-500">
                    {{ $step }} of {{ $totalQuestions }} Questions
                </div>
            </div>
            <div class="row-span-3 w-full flex flex-col gap-2 justify-between overflow-hidden">
                <div class="w-full flex flex-col">
                    <flux:heading size="lg" level="2">
                        <span class="text-2xl">Question {{ $step }}</span> ({{ $question->skill->name }}):
                    </flux:heading>
                    <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                        data-latex='@json($question->question)'>
                        {{ $question->question }}
                    </span>
                </div>
                @if ($question->attachments)
                    <div class="w-full h-full flex gap-1 overflow-auto bg-white rounded-xl border p-2">
                        @foreach ($question->attachment_file_names as $file => $heading)
                            <x-image-modal :file="$file" :heading="$heading" />
                        @endforeach
                    </div>
                @endif
                <div class="w-full flex flex-col">
                    @if ($question->question_type === 'identification_math')
                        <flux:heading size="lg" level="2">Your Answer:</flux:heading>
                        <math-field x-ref="mathField"
                            style="width: 100%; font-size: 1.2rem; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;"></math-field>
                    @else
                        <flux:input label="Your Answer:" class="p-1" x-model="latex" />
                    @endif

                    <input type="hidden" name="answer" x-model="latex" />
                    @error('answer')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row-span-1 flex gap-2 justify-end items-end px-2 py-2">
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
            function answerField() {
                return {
                    latex: '{{ addslashes($answers[$question->id] ?? '') }}',
                    init() {
                        this.$nextTick(() => {
                            const mf = this.$refs.mathField;
                            if (mf) {
                                mf.setOptions({
                                    defaultMode: 'text',
                                    smartMode: true,
                                    smartFence: true,
                                    mathModeSpace: '\\;',
                                });
                                mf.mode = 'text';
                                mf.mathModeSpace = '\\;';
                                mf.value = this.latex || '';
                                mf.addEventListener('input', (e) => {
                                    this.latex = e.target.getValue('latex');
                                });
                            }
                        });
                    },

                    onInput(e) {
                        this.latex = e.target.getValue('latex');
                    },

                    submit() {
                        if (this.$refs.mathField) {
                            this.latex = this.$refs.mathField.getValue('latex');
                        }
                        this.$el.submit();
                    }
                }
            }
        </script>
    </div>
</x-layouts::app>
