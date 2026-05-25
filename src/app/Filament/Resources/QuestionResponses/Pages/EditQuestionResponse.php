<?php

namespace App\Filament\Resources\QuestionResponses\Pages;

use App\Filament\Resources\QuestionResponses\QuestionResponseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuestionResponse extends EditRecord
{
    protected static string $resource = QuestionResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
