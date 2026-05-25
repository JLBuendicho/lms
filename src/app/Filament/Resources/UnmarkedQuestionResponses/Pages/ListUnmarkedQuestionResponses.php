<?php

namespace App\Filament\Resources\UnmarkedQuestionResponses\Pages;

use App\Filament\Resources\UnmarkedQuestionResponses\UnmarkedQuestionResponseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUnmarkedQuestionResponses extends ListRecords
{
    protected static string $resource = UnmarkedQuestionResponseResource::class;

    protected ?string $heading = 'Unmarked Question Responses';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
