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
                        <div class="flex flex-col gap-2">
                            <flux:heading size="lg" level="2">Student's Answer:</flux:heading>
                            <span class="w-full bg-white rounded-xl border overflow-auto latex p-2"
                                data-latex='@json($response->response)'>
                                {{ $response->response ?? 'No answer provided' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layouts::app>
