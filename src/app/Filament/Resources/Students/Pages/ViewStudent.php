<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name'),
                        TextEntry::make('lrn')
                            ->label('Learner Reference Number (LRN)'),
                        TextEntry::make('email')
                            ->label('Email'),
                    ]),

                Section::make('Skill Mastery')
                    ->schema([
                        RepeatableEntry::make('masteryRecords')
                            ->schema([
                                TextEntry::make('skill_name')
                                    ->hiddenLabel(),
                                TextEntry::make('mastery')
                                    ->hiddenLabel()
                                    ->formatStateUsing(fn ($state) => number_format($state * 100, 2) . '%'),
                            ])->columns(2)->label('Mastery Records'),
                    ]),
            ]);
    }
}
