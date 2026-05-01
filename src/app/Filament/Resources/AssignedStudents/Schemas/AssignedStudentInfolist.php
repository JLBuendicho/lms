<?php

namespace App\Filament\Resources\AssignedStudents\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssignedStudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->contained(false)->schema([
                    Section::make('Student Information')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Name'),
                            TextEntry::make('lrn')
                                ->label('Learner Reference Number (LRN)'),
                            TextEntry::make('email')
                                ->label('Email'),
                        ]),
                    Section::make('Metadata')->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
                ]),
                Section::make('Skill Mastery')
                    ->schema([
                        RepeatableEntry::make('masteryRecords')
                            ->schema([
                                TextEntry::make('skill_name')
                                    ->hiddenLabel(),
                                TextEntry::make('mastery')
                                    ->hiddenLabel()
                                    ->formatStateUsing(fn($state) => number_format($state * 100, 2) . '%'),
                            ])->columns(2)->label('Mastery Records'),
                    ]),
            ]);
    }
}
