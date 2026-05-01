<?php

namespace App\Filament\Resources\GradeLvls\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GradeLvlsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Grade Level Information')->schema([
                TextEntry::make('grade_lvl')
                    ->numeric(),
                ]),
                Section::make('Metadata')->schema([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                ]),
            ]);
    }
}
