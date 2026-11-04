<?php

namespace App\Filament\Resources\Subjects\Schemas;

use App\Models\Subjects;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubjectsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subject Information')->schema([
                    TextEntry::make('name'),
                    ColorEntry::make('color')
                        ->state(fn ($record) => Subjects::COLORS[$record->color] ?? null),
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
