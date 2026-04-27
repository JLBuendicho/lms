<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Infolists\Components\MathLiveEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuestionsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    MathLiveEntry::make('question')
                        ->label('Question')
                ])->columnSpanFull(),
                Section::make()->schema([
                    MathLiveEntry::make('answer')
                        ->label('Answer')
                ])->columnSpanFull()->hidden(fn ($record) => empty($record->answer)),
                Section::make()->schema([
                    TextEntry::make('subject.name')
                        ->label('Subject'),
                    TextEntry::make('gradeLvl.grade_lvl')
                        ->numeric()
                        ->label('Grade Level'),
                    TextEntry::make('domain.name')
                        ->label('Domain'),
                    TextEntry::make('topic.name')
                        ->label('Topic'),
                    TextEntry::make('skill.name')
                        ->label('Skill'),
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
