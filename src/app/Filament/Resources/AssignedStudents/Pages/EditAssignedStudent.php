<?php

namespace App\Filament\Resources\AssignedStudents\Pages;

use App\Filament\Resources\AssignedStudents\AssignedStudentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssignedStudent extends EditRecord
{
    protected static string $resource = AssignedStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
