<?php

namespace App\Filament\Resources\Domains\Schemas;

use App\Models\Subjects;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DomainsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('subject_id')
                    ->label('Subject')
                    ->options(Subjects::query()->pluck('name', 'id'))
                    ->required(),
            ]);
    }
}
