<x-layouts::app :title="__('Assessment Results')">
    @php
        $is_validated = false;

        foreach ($responses as $response) {
            if (!$response->is_validated) {
                $is_validated = false;
                break;
            }
            $is_validated = true;
        }
    @endphp
    @if (!$is_validated)
        <div class="h-screen flex justify-center items-center p-8">
            <flux:heading size="xl">
                This assessment is still being marked. Please check back later for the results.
            </flux:heading>
        </div>
    @else
        <div class="h-screen p-8 flex flex-col gap-4 justify-center items-center">
            <div class="w-full">
                <flux:heading size="xl" class="text-5xl">
                    {{ ucfirst($assessmentType) }} Assessment - {{ ucfirst($subjectName) }}
                </flux:heading>
            </div>

            <div class="w-full flex-1 flex flex-col gap-4 overflow-auto rounded-xl border border-zinc-200 shadow-sm">
                @foreach ($responses as $response)
                    <div class="bg-zinc-100 rounded-xl border border-zinc-200 shadow-sm p-6 flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="w-full flex justify-between">
                                <flux:heading size="lg" level="2">
                                    Question {{ $response->question->id }}
                                    ({{ $response->question->skill->name }})
                                    :
                                </flux:heading>
                                <flux:badge color="{{ $response->correct ? 'green' : 'red' }}">
                                    {{ $response->correct ? 'Correct' : 'Incorrect' }}
                                </flux:badge>
                            </div>
                            <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                                data-latex='@json($response->question->question)'>
                                {{ $response->question->question }}
                            </span>
                        </div>
                        @if ($response->question->attachments)
                            <div class="w-full h-full flex gap-1 overflow-auto bg-white rounded-xl border p-2">
                                @foreach ($response->question->attachment_file_names as $file => $heading)
                                    <x-image-modal :file="$file" :heading="$heading" :id="$response->id" />
                                @endforeach
                            </div>
                        @endif
                        @if ($response->question->answers)
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex justify-between">
                                    <flux:heading size="lg" level="2">
                                        Correct Answer
                                    </flux:heading>
                                </div>
                                @foreach ($response->question->answers as $answer)
                                    <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                                        @if (str_ends_with($response->question->question_type, '_math')) data-latex='@json($answer)' @endif>
                                        {{ $answer }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex flex-col gap-2">
                            <flux:heading size="lg" level="2">Your Answer/s:</flux:heading>
                            @foreach ($response->response as $studentAnswer)
                                @if ($studentAnswer)
                                    <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                                        @if (str_ends_with($response->question->question_type, '_math')) data-latex='@json($studentAnswer)' @endif>
                                        {{ $studentAnswer }}
                                    </span>
                                @else
                                    <span class="w-full bg-white rounded-xl border overflow-auto latex p-2">
                                        No answer provided
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layouts::app>
