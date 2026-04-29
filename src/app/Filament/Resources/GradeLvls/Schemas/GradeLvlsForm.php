<?php

namespace App\Filament\Resources\GradeLvls\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GradeLvlsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('grade_lvl')
                    ->required()
                    ->numeric(),
            ]);
    }
}
