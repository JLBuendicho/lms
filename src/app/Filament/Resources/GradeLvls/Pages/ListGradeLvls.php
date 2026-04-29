<?php

namespace App\Filament\Resources\GradeLvls\Pages;

use App\Filament\Resources\GradeLvls\GradeLvlsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGradeLvls extends ListRecords
{
    protected static string $resource = GradeLvlsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
