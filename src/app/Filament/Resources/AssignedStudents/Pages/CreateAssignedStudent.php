<?php

namespace App\Filament\Resources\AssignedStudents\Pages;

use App\Filament\Resources\AssignedStudents\AssignedStudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssignedStudent extends CreateRecord
{
    protected static string $resource = AssignedStudentResource::class;
}
