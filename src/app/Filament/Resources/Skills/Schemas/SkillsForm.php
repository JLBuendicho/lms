<?php

namespace App\Filament\Resources\Skills\Schemas;

use App\Models\Domains;
use App\Models\Subjects;
use App\Models\Topics;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class SkillsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('subject_id')
                    ->live()
                    ->label('Subject')
                    ->options(Subjects::query()->pluck('name', 'id'))
                    ->required(),
                Select::make('domain_id')
                    ->live()
                    ->label('Domain')
                    ->disabled(fn(Get $get) => blank($get('subject_id')))
                    ->options(
                        fn(Get $get) => Domains::query()
                            ->where('subject_id', $get('subject_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),
                Select::make('topic_id')
                    ->live()
                    ->label('Topic')
                    ->disabled(fn(Get $get) => blank($get('domain_id')))
                    ->options(
                        fn(Get $get) => Topics::query()
                            ->where('domain_id', $get('domain_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),
            ]);
    }
}
