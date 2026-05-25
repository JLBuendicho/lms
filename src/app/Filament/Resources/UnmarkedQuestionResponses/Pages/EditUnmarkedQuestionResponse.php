<?php

namespace App\Filament\Resources\UnmarkedQuestionResponses\Pages;

use App\Filament\Resources\UnmarkedQuestionResponses\UnmarkedQuestionResponseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUnmarkedQuestionResponse extends EditRecord
{
    protected static string $resource = UnmarkedQuestionResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
