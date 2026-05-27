<?php

namespace App\Filament\Resources\Instructors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;
use Illuminate\Validation\Rules\Password;

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
                    ->rules([Password::defaults()])
                    ->revealable()
                    ->hiddenOn(Operation::Edit)
                    ->visibleOn(Operation::Create)
                    ->maxLength(255),
            ]);
    }
}
