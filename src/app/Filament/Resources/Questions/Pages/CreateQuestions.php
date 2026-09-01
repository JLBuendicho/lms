<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateQuestions extends CreateRecord
{
    protected static string $resource = QuestionsResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['answers'] = match ($data['question_type']) {
            'identification' => $data['answer_text'] !== null ? [$data['answer_text']] : null,
            'identification_math' => $data['answer_math'] !== null ? [$data['answer_math']] : null,
            'true_false' => $data['answer_radio'] !== null ? [$data['answer_radio']] : null,
            'multiple_choice', 'multiple_choice_math' => $data['answer_choices'] ?? [],
            default => null,
        };

        unset($data['answer_text'], $data['answer_math'], $data['answer_choices'], $data['answer_radio']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->getRecord();
        $files = $record->attachments;
        $oldFileNames = $record->attachment_file_names ?? [];

        if (is_array($files) && count($files) > 0) {
            $updatedFiles = [];
            $updatedFileNames = [];

            foreach ($files as $oldPath) {
                if (Str::startsWith($oldPath, 'questions/tmp/')) {
                    $newPath = str_replace('questions/tmp/', "questions/{$record->id}/", $oldPath);

                    if (Storage::disk('public')->move($oldPath, $newPath)) {
                        $updatedFiles[] = $newPath;
                        // Remap the original filename to the new path key
                        if (isset($oldFileNames[$oldPath])) {
                            $updatedFileNames[$newPath] = $oldFileNames[$oldPath];
                        }
                    } else {
                        $updatedFiles[] = $oldPath;
                        $updatedFileNames[$oldPath] = $oldFileNames[$oldPath] ?? null;
                    }
                } else {
                    $updatedFiles[] = $oldPath;
                    $updatedFileNames[$oldPath] = $oldFileNames[$oldPath] ?? null;
                }
            }

            $record->update([
                'attachments'           => $updatedFiles,
                'attachment_file_names' => $updatedFileNames,
            ]);
        }
    }
}
