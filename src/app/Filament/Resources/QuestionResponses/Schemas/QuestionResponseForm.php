<?php

namespace App\Filament\Resources\QuestionResponses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuestionResponseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('skill_id')
                    ->required()
                    ->numeric(),
                TextInput::make('skill_name')
                    ->required(),
                Textarea::make('response')
                    ->columnSpanFull(),
                Toggle::make('correct')
                    ->required(),
                TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('assessment_type')
                    ->required()
                    ->default('practice'),
                Toggle::make('is_validated')
                    ->required(),
                Toggle::make('mastery_is_recorded')
                    ->required(),
            ]);
    }
}
