<?php

namespace App\Filament\Resources\LearningMaterials\Pages;

use App\Filament\Resources\LearningMaterials\LearningMaterialResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateLearningMaterial extends CreateRecord
{
    protected static string $resource = LearningMaterialResource::class;

    protected function afterCreate(): void
    {
        $record = $this->getRecord();
        $files = $record->attachments;
        $oldFileNames = $record->attachment_file_names ?? [];

        if (is_array($files) && count($files) > 0) {
            $updatedFiles = [];
            $updatedFileNames = [];

            foreach ($files as $oldPath) {
                if (Str::startsWith($oldPath, 'learning_materials/attachments/tmp/')) {
                    $newPath = str_replace('learning_materials/attachments/tmp/', "learning_materials/{$record->id}/attachments/", $oldPath);

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

        $audioVisualPath = $record->content_audio_visual_path;
        if ($audioVisualPath) {
            if (Str::startsWith($audioVisualPath, 'learning_materials/audio_visual/tmp/')) {
                $newAudioVisualPath = str_replace('learning_materials/audio_visual/tmp/', "learning_materials/{$record->id}/audio_visual/", $audioVisualPath);

                if (Storage::disk('public')->move($audioVisualPath, $newAudioVisualPath)) {
                    $record->update(['content_audio_visual_path' => $newAudioVisualPath]);
                } else {
                    $record->update(['content_audio_visual_path' => $audioVisualPath]); // Fallback if move fails
                }

                Storage::disk('public')->delete($audioVisualPath);
            }
        }
    }
}
