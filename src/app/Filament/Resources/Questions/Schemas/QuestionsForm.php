<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Forms\Components\MathLiveField;
use App\Models\Domains;
use App\Models\GradeLvls;
use App\Models\Questions;
use App\Models\Skills;
use App\Models\Subjects;
use App\Models\Topics;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class QuestionsForm
{
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                Select::make("question_type")
                    ->label("Question Type")
                    ->options([
                        'identification' => 'Identification',
                        'identification_math' => 'Identification (Math)',
                        'multiple_choice' => 'Multiple Choice',
                        'multiple_choice_math' => 'Multiple Choice (Math)',
                        'true_false' => 'True or False',
                    ])
                    ->selectablePlaceholder(false)
                    ->live()
                    ->required(),
                Textarea::make('question')
                    ->required()
                    ->columnSpanFull(),
                // MathLiveField::make('question')
                //     ->label('Question')
                //     ->columnSpanFull()
                //     ->required(),
                FileUpload::make('attachments')
                    ->label('Attached Images')
                    ->multiple()
                    ->disk('public')
                    // ->directory(fn (?Questions $record) => $record ? "questions/{$record->id}" : "questions/tmp")
                    ->directory(function (string $operation, ?Questions $record) {
                        if ($record?->id) {
                            return "questions/{$record->id}";
                        }
                        return "questions/tmp"; // handle move after create
                    })
                    ->storeFileNamesIn('attachment_file_names'),
                Textarea::make('answer_text')
                    ->label('Answers')
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('question_type') === 'identification')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'identification'),

                MathLiveField::make('answer_math')
                    ->label('Answers')
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('question_type') === 'identification_math')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'identification_math'),

                Repeater::make('answer_choices')
                    ->label('Answers')
                    ->columnSpanFull()
                    ->default([])
                    ->simple(Textarea::make('answer')->label('Answer')->required())
                    ->grid(3)
                    ->addActionLabel('Add Answer')
                    ->visible(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math']))
                    ->dehydrated(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math']))
                    ->required(),
                Select::make('subject_id')
                    ->live()
                    ->label('Subject')
                    ->options(Subjects::query()->pluck('name', 'id'))
                    ->required(),
                Select::make('grade_lvl_id')
                    ->live()
                    ->label('Grade Level')
                    ->options(GradeLvls::query()->pluck('grade_lvl', 'id'))
                    ->required(),
                Select::make('domain_id')
                    ->live()
                    ->label('Domain')
                    ->disabled(fn(Get $get) => blank($get('grade_lvl_id')))
                    ->options(fn(Get $get) => Domains::query()
                        ->whereHas(
                            'gradeLvls',
                            fn($query) => $query->where('grade_lvls_id', $get('grade_lvl_id'))
                        )->pluck('name', 'id'))
                    ->required(),
                Select::make('topic_id')
                    ->live()
                    ->label('Topic')
                    ->disabled(fn(Get $get) => blank($get('domain_id')))
                    ->options(
                        fn(Get $get) => Topics::query()
                            ->where('domain_id', $get('domain_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),
                Select::make('skill_id')
                    ->live()
                    ->label('Skill')
                    ->disabled(fn(Get $get) => blank($get('topic_id')))
                    ->options(
                        fn(Get $get) => Skills::query()
                            ->where('topic_id', $get('topic_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),
                Select::make('assessment_type')
                    ->live()
                    ->label('Assessment Type')
                    ->options([
                        'initial' => 'Initial Assessment',
                        'middle' => 'Middle Assessment',
                        'final' => 'Final Assessment',
                    ]),
            ]);
    }
}
