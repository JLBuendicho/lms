<?php

namespace App\Filament\Resources\AssignedStudents\Schemas;

use App\Models\GradeLvls;
use App\Models\Subjects;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class AssignedStudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('lrn')
                            ->label('Learner Reference Number (LRN)')
                            ->helperText(
                                'The permanent 12-digit number from the DepEd Learner Information System.'
                            )
                            ->mask('999999999999')
                            ->length(12)
                            ->numeric()
                            ->unique('users', 'lrn', ignoreRecord: true),
                    ]),

                Section::make('Subject Proficiency Level')
                    ->schema(function (?object $record) {
                        if (! $record) {
                            return [];
                        }

                        $instructorSubjectIds = auth()->user()
                            ->subjects()
                            ->pluck('subjects.id');

                        $commonSubjects = $record->subjects()
                            ->whereIn('subjects.id', $instructorSubjectIds)
                            ->get();

                        $proficiencyLvls = GradeLvls::query()
                            ->pluck('grade_lvl')
                            ->mapWithKeys(fn($gradeLvl) => [
                                'grade_' . $gradeLvl => 'Grade ' . $gradeLvl,
                            ])
                            ->toArray();

                        return $commonSubjects
                            ->map(function (Subjects $subject) use ($proficiencyLvls) {
                                $subjectId = $subject->id;

                                return Section::make($subject->name)
                                    ->schema([
                                        Select::make(
                                            "initial_proficiency_lvls.$subjectId"
                                        )
                                            ->label('Initial')
                                            ->options($proficiencyLvls)
                                            ->native(false)
                                            ->dehydrated(),

                                        Select::make(
                                            "middle_proficiency_lvls.$subjectId"
                                        )
                                            ->label('Middle')
                                            ->options($proficiencyLvls)
                                            ->native(false)
                                            ->disabled(
                                                fn(Get $get) =>
                                                blank(
                                                    $get(
                                                        "initial_proficiency_lvls.$subjectId"
                                                    )
                                                )
                                            )
                                            ->dehydrated(),

                                        Select::make(
                                            "final_proficiency_lvls.$subjectId"
                                        )
                                            ->label('Final')
                                            ->options($proficiencyLvls)
                                            ->native(false)
                                            ->disabled(
                                                fn(Get $get) =>
                                                blank(
                                                    $get(
                                                        "middle_proficiency_lvls.$subjectId"
                                                    )
                                                )
                                            )
                                            ->dehydrated(),
                                    ])
                                    ->columns(3);
                            })
                            ->values()
                            ->all();
                    }),
            ]);
    }
}
