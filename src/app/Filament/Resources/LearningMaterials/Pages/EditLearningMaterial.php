<?php

namespace App\Filament\Resources\LearningMaterials\Pages;

use App\Filament\Resources\LearningMaterials\LearningMaterialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditLearningMaterial extends EditRecord
{
    protected static string $resource = LearningMaterialResource::class;

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
        $storedFiles = $disk->files("learning_materials/{$record->id}/attachments");

        foreach ($storedFiles as $file) {
            if (!in_array($file, $currentFiles)) {
                $disk->delete($file);
            }
        }

        $currentAudioVisual = $record->content_audio_visual_path;
        $storedAudioVisual = $disk->files("learning_materials/{$record->id}/audio_visual");

        foreach ($storedAudioVisual as $file) {
            if (empty($currentAudioVisual)) {
                $disk->delete($file);
            } else if ($file !== $currentAudioVisual) {
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
