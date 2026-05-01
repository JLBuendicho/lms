<?php

namespace App\Filament\Resources\GradeLvls\Pages;

use App\Filament\Resources\GradeLvls\GradeLvlsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGradeLvls extends ViewRecord
{
    protected static string $resource = GradeLvlsResource::class;

    protected ?string $heading = 'View Grade Level';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
