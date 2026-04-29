<?php

namespace App\Filament\Resources\GradeLvls\Pages;

use App\Filament\Resources\GradeLvls\GradeLvlsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGradeLvls extends EditRecord
{
    protected static string $resource = GradeLvlsResource::class;

    protected ?string $heading = 'Edit Grade Level';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
