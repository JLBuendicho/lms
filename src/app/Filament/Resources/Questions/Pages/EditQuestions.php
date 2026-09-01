<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditQuestions extends EditRecord
{
    protected static string $resource = QuestionsResource::class;

    protected ?string $heading = 'Edit Question';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     $data['answers'] = match ($data['question_type']) {
    //         'identification' => $data['answer_text'] !== null ? [$data['answer_text']] : null,
    //         'identification_math' => $data['answer_math'] !== null ? [$data['answer_math']] : null,
    //         'multiple_choice', 'multiple_choice_math' => $data['answer_choices'] ?? [],
    //         default => null,
    //     };

    //     unset($data['answer_text'], $data['answer_math'], $data['answer_choices']);

    //     return $data;
    // }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $answers = $data['answers'] ?? [];

        $data['answer_text'] = $data['question_type'] === 'identification'
            ? ($answers[0] ?? null)
            : null;

        $data['answer_math'] = $data['question_type'] === 'identification_math'
            ? ($answers[0] ?? null)
            : null;

        $data['answer_choices'] = in_array($data['question_type'], ['multiple_choice', 'multiple_choice_math'])
            ? $answers
            : [];

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['answers'] = match ($data['question_type']) {
            'identification' => $data['answer_text'] !== null ? [$data['answer_text']] : null,
            'identification_math' => $data['answer_math'] !== null ? [$data['answer_math']] : null,
            'multiple_choice', 'multiple_choice_math' => $data['answer_choices'] ?? [],
            default => null,
        };

        unset($data['answer_text'], $data['answer_math'], $data['answer_choices']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord();
        $disk = Storage::disk('public');

        $currentFiles = $record->attachments ?? [];
        $storedFiles = $disk->files("questions/{$record->id}");

        foreach ($storedFiles as $file) {
            if (!in_array($file, $currentFiles)) {
                $disk->delete($file);
            }
        }

        // Sync attachment_file_names to only include current files
        $currentFileNames = collect($record->attachment_file_names ?? [])
            ->only($currentFiles)
            ->toArray();

        $record->updateQuietly(['attachment_file_names' => $currentFileNames]);
    }
}
