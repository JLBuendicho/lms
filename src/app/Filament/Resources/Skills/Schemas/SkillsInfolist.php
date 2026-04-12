<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextEntry::make('name'),
                    TextEntry::make('topic.domain.subject.name')
                        ->label('Subject Name'),
                    TextEntry::make('topic.domain.name')
                        ->label('Domain Name'),
                    TextEntry::make('topic.name')
                        ->label('Topic Name'),
                ]),
                Section::make()->schema([
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
