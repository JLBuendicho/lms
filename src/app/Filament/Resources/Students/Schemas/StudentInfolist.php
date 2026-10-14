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
                    section::make('student information')
                        ->schema([
                            textentry::make('name')
                                ->label('name'),
                            textentry::make('lrn')
                                ->label('learner reference number (lrn)'),
                            textentry::make('email')
                                ->label('email'),
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
