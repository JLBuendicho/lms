<?php

namespace App\Filament\Resources\QuestionResponses\Pages;

use App\Filament\Resources\QuestionResponses\QuestionResponseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuestionResponses extends ListRecords
{
    protected static string $resource = QuestionResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
