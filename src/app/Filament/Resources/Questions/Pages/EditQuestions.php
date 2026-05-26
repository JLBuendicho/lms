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
