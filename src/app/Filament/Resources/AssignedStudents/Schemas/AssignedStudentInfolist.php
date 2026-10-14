<?php

namespace App\Filament\Resources\AssignedStudents\Schemas;

use App\Models\GradeLvls;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;

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
                Section::make()->contained(false)->schema([
                    Section::make('Subject Proficiency Level')
                        ->schema(function ($record) {
                            if (! $record) {
                                return [];
                            }

                            /*
                                 * Subjects shared by:
                                 *   - the student
                                 *   - the currently authenticated instructor
                                 */
                            $instructorSubjectIds = auth()
                                ->user()
                                ->subjects()
                                ->pluck('subjects.id');

                            $commonSubjects = $record
                                ->subjects()
                                ->whereIn('subjects.id', $instructorSubjectIds)
                                ->get();

                            if ($commonSubjects->isEmpty()) {
                                return [
                                    TextEntry::make('no_subjects')
                                        ->label('')
                                        ->state('No common subjects found.')
                                        ->color('gray'),
                                ];
                            }

                            /*
                                 * Convert:
                                 *
                                 * [
                                 *     '1' => 'grade_7',
                                 *     '2' => 'grade_8',
                                 * ]
                                 *
                                 * into:
                                 *
                                 * [
                                 *     'grade_7' => 'Grade 7',
                                 *     'grade_8' => 'Grade 8',
                                 * ]
                                 */
                            $proficiencyLevels = GradeLvls::query()
                                ->pluck('grade_lvl')
                                ->mapWithKeys(fn($gradeLvl) => [
                                    'grade_' . $gradeLvl => 'Grade ' . $gradeLvl,
                                ])
                                ->toArray();

                            return $commonSubjects
                                ->map(function ($subject) use (
                                    $record,
                                    $proficiencyLevels
                                ) {
                                    $subjectId = $subject->id;

                                    return Section::make($subject->name)
                                        ->schema([
                                            TextEntry::make(
                                                "initial_proficiency_{$subjectId}"
                                            )
                                                ->label('Initial')
                                                ->state(
                                                    $proficiencyLevels[$record->initial_proficiency_lvls[$subjectId]
                                                        ?? null] ?? '-'
                                                ),

                                            TextEntry::make(
                                                "middle_proficiency_{$subjectId}"
                                            )
                                                ->label('Middle')
                                                ->state(
                                                    $proficiencyLevels[$record->middle_proficiency_lvls[$subjectId]
                                                        ?? null] ?? '-'
                                                ),

                                            TextEntry::make(
                                                "final_proficiency_{$subjectId}"
                                            )
                                                ->label('Final')
                                                ->state(
                                                    $proficiencyLevels[$record->final_proficiency_lvls[$subjectId]
                                                        ?? null] ?? '-'
                                                ),
                                        ])
                                        ->columns(3);
                                })
                                ->values()
                                ->all();
                        }),
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
                ]),
            ]);
    }
}
