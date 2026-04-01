<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class StudentForm
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
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password()
                    ->hiddenOn(Operation::Edit)
                    ->visibleOn(Operation::Create)
                    ->maxLength(255),
            ]);
    }
}
