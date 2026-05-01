<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Infolists\Components\MathLiveEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuestionsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Question')->schema([
                    MathLiveEntry::make('question')
                        ->hiddenLabel(true)
                ])->columnSpanFull(),
                Section::make('Answer')->schema([
                    MathLiveEntry::make('answer')
                ])->columnSpanFull()->hidden(fn($record) => empty($record->answer)),
                Section::make()->contained(false)->schema([
                    Section::make('Question Information')->schema([
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
                    Section::make()->contained(false)->schema([
                        Section::make('Metadata')->schema([
                            TextEntry::make('created_at')
                                ->dateTime()
                                ->placeholder('-'),
                            TextEntry::make('updated_at')
                                ->dateTime()
                                ->placeholder('-'),
                        ]),
                        Section::make('Assessment Type')->schema([
                            TextEntry::make('assessment_type')
                        ])->hidden(fn($record) => empty($record->assessment_type)),
                    ]),
                ])->columns(2)->columnSpanFull(),
            ]);
    }
}
