<?php

namespace App\Filament\Resources\AssignedStudents\Pages;

use App\Filament\Resources\AssignedStudents\AssignedStudentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssignedStudent extends ViewRecord
{
    protected static string $resource = AssignedStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
