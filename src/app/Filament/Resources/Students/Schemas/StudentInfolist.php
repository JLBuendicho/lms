<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class StudentInfolist
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
                ViewEntry::make('subject_mastery_chart')
                    ->view('filament.resources.subjects.widgets.student-subject-mastery-chart')
                    ->viewData(fn(Model $record) => [
                        'studentId' => $record->id,
                        'subjectId' => 1,
                    ]),
            ]);
    }
}
