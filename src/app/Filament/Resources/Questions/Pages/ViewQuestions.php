<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewQuestions extends ViewRecord
{
    protected static string $resource = QuestionsResource::class;

    protected ?string $heading = 'View Question';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
