<?php

namespace App\Filament\Resources\AssignedStudents\Pages;

use App\Filament\Resources\AssignedStudents\AssignedStudentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssignedStudents extends ListRecords
{
    protected static string $resource = AssignedStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
