<?php

namespace App\Filament\Resources\AssignedStudents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class AssignedStudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('lrn')
                    ->label('Learner Reference Number (LRN)')
                    ->helperText('The permanent 12-digit number from the DepEd Learner Information System.')
                    ->mask('999999999999')
                    ->length(12)
                    ->numeric()
                    ->unique('users', 'lrn', ignoreRecord: true),
            ]);
    }
}
