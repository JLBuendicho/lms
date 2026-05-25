<?php

use App\Models\QuestionResponse;
use Livewire\Component;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

new class extends Component {
    public int $userId;
    public string $subjectName;
    public string $assessmentType;
    public array $marks = [];
    public string $redirectUrl;

    public function mount(int $userId, string $subjectName, string $assessmentType): void
    {
        $this->userId = $userId;
        $this->subjectName = $subjectName;
        $this->assessmentType = $assessmentType;
        $this->redirectUrl = '/admin/unmarked-question-responses';

        foreach ($this->getResponses() as $response) {
            $this->marks[$response->id] = (bool) $response->correct;

            if ($response->is_validated) {
                $this->redirectUrl = '/admin/question-responses';
            }
        }
    }

    public function mark(int $responseId, bool $correct): void
    {
        $this->marks[$responseId] = $correct;
    }

    public function finalize()
    {
        $userName = $this->getResponses()->first()->user->name ?? 'Unknown Student';

        foreach ($this->marks as $responseId => $correct) {
            QuestionResponse::where('id', $responseId)->update(['correct' => $correct, 'is_validated' => true]);
        }

        if ($this->redirectUrl === '/admin/unmarked-question-responses') {
            Notification::make()->title('Info')
            ->body("Finalized Asessment Responses can be viewed and edited in the 'Question Responses' section.")
            ->icon('heroicon-o-information-circle')
            ->actions([
                Action::make('view-responses')
                    ->label('View Finalized Responses')
                    ->button()
                    ->url('question-responses'),
            ])
            ->send();
        }

        Notification::make()->title('Marks finalized')
            ->body("The marks for $userName's assessment have been saved.")
            ->success()
            ->color('success')
            ->send();

        return redirect($this->redirectUrl);
    }

    public function getResponses()
    {
        return QuestionResponse::where('user_id', $this->userId)
            ->where('assessment_type', $this->assessmentType)
            ->whereRelation('question', function ($query) {
                $query->whereRelation('subject', 'name', $this->subjectName);
            })
            ->with(['question.skill', 'user'])
            ->orderBy('question_id')
            ->get();
    }
}; ?>

<div class="h-screen flex flex-col gap-4 justify-center items-center p-4 bg-zinc-100">
    <div class="w-full">
        <flux:heading size="xl" class="text-5xl">
            {{ ucfirst($assessmentType) }} Assessment - {{ $subjectName }} <br>
            Student: {{ $this->getResponses()->first()->user->name ?? 'Unknown Student' }}
        </flux:heading>
    </div>

    <div
        class="w-3/4 flex-1 overflow-auto flex flex-col gap-4 items-center p-4 bg-white rounded-xl border border-zinc-200 shadow-sm">
        <div class="w-full h-full flex flex-col gap-4 overflow-auto rounded-xl border border-zinc-200 shadow-sm">
            @foreach ($this->getResponses() as $response)
                <div class="bg-zinc-100 rounded-xl border border-zinc-200 shadow-sm p-6 flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="w-full flex justify-between">
                            <flux:heading size="lg" level="2">
                                Question {{ $response->question->id }}
                                ({{ $response->question->skill->name }})
                                :
                            </flux:heading>
                            <flux:badge color="{{ $marks[$response->id] ? 'green' : 'red' }}">
                                Marked as: {{ $marks[$response->id] ? 'Correct' : 'Incorrect' }}
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
                            data-latex='@json($response->answer)'>
                            {{ $response->answer ?? 'No answer provided' }}
                        </span>
                    </div>
                    <div class="flex gap-2 justify-end items-end">
                        <flux:button variant="primary" color="red"
                            wire:click="mark({{ $response->id }}, false)" class="cursor-pointer">
                            Mark as Incorrect
                        </flux:button>
                        <flux:button variant="primary" color="green"
                            wire:click="mark({{ $response->id }}, true)" class="cursor-pointer">
                            Mark as Correct
                        </flux:button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full flex gap-2 justify-end items-end">
            <flux:button href="{{ $this->redirectUrl }}">
                Cancel
            </flux:button>
            <flux:button variant="primary" wire:click="finalize" wire:loading.attr="disabled" class="cursor-pointer">
                <span wire:loading.remove wire:target="finalize">Finalize Marks</span>
                <span wire:loading wire:target="finalize">Saving...</span>
            </flux:button>
        </div>
    </div>
</div>
