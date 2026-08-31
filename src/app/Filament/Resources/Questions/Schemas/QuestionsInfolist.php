<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Infolists\Components\MathLiveEntry;
use Dom\Text;
use Filament\Infolists\Components\RepeatableEntry;
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
                Section::make('Question')->schema([
                    MathLiveEntry::make('question')
                        ->hiddenLabel(true)
                ])->columnSpanFull(),
                Section::make('Attached Images')->schema([
                    ViewEntry::make('attachment_file_names')
                        ->view('filament.infolists.components.attached-images-entry'),
                ])->columnSpanFull()->hidden(fn($record) => empty($record->attachments)),
                Section::make()->schema([
                    RepeatableEntry::make('answers')
                    ->state(fn ($record) => collect($record->answers)
                        ->map(fn ($answer) => ['value' => $answer])
                        ->all()
                    )
                    ->schema([
                        TextEntry::make('value')
                            // ->getStateUsing(fn ($state) => $state)
                            ->hiddenLabel()
                            ->visible(fn ($record) => !in_array($record->question_type, ['identification_math', 'multiple_choice_math'])),
                        MathLiveEntry::make('value')
                            // ->getStateUsing(fn ($state) => $state)
                            ->hiddenLabel()
                            ->visible(fn ($record) => in_array($record->question_type, ['identification_math', 'multiple_choice_math'])),
                    ])->grid(4),
                ])->columnSpanFull()->hidden(fn($record) => empty($record->answers)),
                Section::make()->contained(false)->schema([
                    Section::make('Question Information')->schema([
                        TextEntry::make('question_type')
                            ->formatStateUsing(fn (string $state) => ucwords(str_replace('_', ' ', $state)))
                            ->label('Question Type'),
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
