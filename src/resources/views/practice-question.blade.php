@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    @php
        $subject = $skill->topic->domain->subject;
    @endphp
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $skill->topic->domain->subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $skill->topic->domain->id]) }}">
            {{ $skill->topic->domain->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}">
            {{ $skill->topic->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('questions.practice', ['skillId' => $skill->id]) }}">
            {{ $skill->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Practice Question for ' . $skill->name }}
            </flux:heading>

            <form method="POST" action="{{ route('questions.practice.evaluate') }}"
                class="h-full w-full grid grid-rows-[10%, 80%, 10%]"
                x-data="answerField()" @submit.prevent="submit">
                @csrf
                <div class="row-span-3 w-full flex flex-col gap-2 justify-between overflow-hidden">
                    <div class="w-full flex flex-col">
                        <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                            data-latex='@json($questionText)'>
                            {{ $questionText }}
                        </span>
                    </div>
                    @if ($attachments)
                        <div class="w-full h-full flex gap-1 overflow-auto bg-white rounded-xl border p-2">
                            @foreach ($attachmentFileNames as $file => $heading)
                                <x-image-modal :file="$file" :heading="$heading" />
                            @endforeach
                        </div>
                    @endif
                    <div class="w-full flex flex-col">
                        @if ($questionType === 'identification_math')
                            <flux:heading size="lg" level="2">Your Answer:</flux:heading>
                            <math-field x-ref="mathField"
                                style="width: 100%; font-size: 1.2rem; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;"></math-field>
                        @elseif ($questionType === 'multiple_choice')
                            <flux:heading size="lg" level="2">Choices:</flux:heading>
                            <flux:checkbox.group label="" x-model="latex" variant="buttons">
                                @foreach ($questionChoices as $choice)
                                    <flux:checkbox value="{{ $choice }}" label="{{ $choice }}"
                                        class="w-full flex justify-start" />
                                @endforeach
                            </flux:checkbox.group>
                        @elseif ($questionType === 'multiple_choice_math')
                            <flux:heading size="lg" level="2">Choices:</flux:heading>
                            <flux:checkbox.group label="" x-model="latex" variant="buttons">
                                @foreach ($questionChoices as $choice)
                                    <flux:checkbox value="{{ $choice }}" label=""
                                        class="w-full flex justify-start">
                                        {{-- <span class="overflow-auto latex p-2" data-latex='@json($choice)'>
                                        {{ $choice }}
                                    </span> --}}
                                        <math-div>
                                            {{ $choice }}
                                        </math-div>
                                    </flux:checkbox>
                                @endforeach
                            </flux:checkbox.group>
                        @else
                            <flux:input label="Your Answer:" class="p-1" x-model="latex[0]" />
                        @endif

                        <template x-for="(item, index) in latex" :key="index">
                            <input type="hidden" name="answer[]" :value="item">
                        </template>

                        @error('answer')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row-span-1 flex gap-2 justify-end items-end px-2 py-2">
                    <flux:button type="submit" variant="primary">
                        Submit
                    </flux:button>
                </div>
            </form>

            <script>
                function answerField() {
                    return {
                        latex: @json(array_values((array) (in_array($questionType, ['multiple_choice', 'multiple_choice_math']) ? [] : ['']))),
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
                                    mf.value = this.latex[0] || '';
                                    mf.addEventListener('input', (e) => {
                                        this.latex[0] = e.target.getValue('latex');
                                    });
                                }
                            });
                        },

                        submit() {
                            if (this.$refs.mathField) {
                                this.latex[0] = this.$refs.mathField.getValue('latex');
                            }
                            this.$el.submit();
                        }
                    }
                }
            </script>

        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $skill->topic->id, 'class' => 'bg-zinc-100 flex flex-col justify-center items-center'])
    </div>
</x-layouts::subjects>
