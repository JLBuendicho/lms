<?php

namespace App\Filament\Resources\Instructors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class InstructorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->hiddenOn(Operation::Edit)
                    ->visibleOn(Operation::Create)
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
