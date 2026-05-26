<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Models\BktSkillParams;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'student';

        return $data;
    }
}
