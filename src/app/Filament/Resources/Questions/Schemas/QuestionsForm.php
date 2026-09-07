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
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;

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
                Repeater::make('choices_text')
                    ->label('Choices')
                    ->columnSpanFull()
                    ->default([])
                    ->simple(Textarea::make('choice')->label('Choice')->required()->live())
                    ->grid(2)
                    ->addActionLabel('Add Choice')
                    ->live()
                    ->visible(fn(Get $get) => $get('question_type') === 'multiple_choice')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'multiple_choice'),
                Repeater::make('choices_math')
                    ->label('Choices')
                    ->columnSpanFull()
                    ->default([])
                    ->simple(MathLiveField::make('choice')->label('Choice')->required()->live())
                    ->grid(2)
                    ->addActionLabel('Add Choice')
                    ->live()
                    ->visible(fn(Get $get) => $get('question_type') === 'multiple_choice_math')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'multiple_choice_math'),
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
                    ->label('Answer')
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('question_type') === 'identification')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'identification'),
                MathLiveField::make('answer_math')
                    ->label('Answer')
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('question_type') === 'identification_math')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'identification_math'),
                Radio::make('answer_radio')
                    ->label('Answer')
                    ->options([
                        'true' => 'True',
                        'false' => 'False',
                    ])
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('question_type') === 'true_false')
                    ->dehydrated(fn(Get $get) => $get('question_type') === 'true_false'),
                // Repeater::make('answer_choices')
                //     ->label('Answers')
                //     ->columnSpanFull()
                //     ->default([])
                //     ->simple(Textarea::make('answer')->label('Answer')->required())
                //     ->grid(2)
                //     ->addActionLabel('Add Answer')
                //     ->visible(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math']))
                //     ->dehydrated(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math'])),
                Repeater::make('answer_choices')
                    ->label('Answers')
                    ->columnSpanFull()
                    ->default([])
                    ->schema([
                        Select::make('value')
                            ->label('Answer')
                            ->required()
                            ->live()
                            ->options(function (Get $get) {
                                $sourceKey = $get('../../question_type') === 'multiple_choice'
                                    ? 'choices_text'
                                    : 'choices_math';

                                $raw = $get('../../' . $sourceKey);

                                $allChoices = collect($raw ?? [])
                                    ->filter(fn($choice) => filled($choice))
                                    ->mapWithKeys(function ($choice, $index) {
                                        $label = is_array($choice) ? ($choice['choice'] ?? '') : $choice;
                                        return [$label => $label];
                                    });

                                $selectedElsewhere = collect($get('../../answer_choices') ?? [])
                                    ->pluck('value')
                                    ->reject(fn($value) => $value === $get('value'))
                                    ->filter()
                                    ->all();

                                return $allChoices->except($selectedElsewhere)->all();
                            }),
                    ])
                    ->grid(2)
                    ->addActionLabel('Add Answer')
                    ->visible(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math']))
                    ->dehydrated(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math'])),
                // Repeater::make('answer_choices')
                //     ->label('Answers')
                //     ->columnSpanFull()
                //     ->default([])
                //     ->schema([
                //         Select::make('value')
                //             ->label('Answer')
                //             ->required()
                //             ->live()
                //             // ->options(function (Get $get) {
                //             //     $sourceKey = $get('../../question_type') === 'multiple_choice'
                //             //         ? 'choices_text'
                //             //         : 'choices_math';

                //             //     $allChoices = collect($get('../../' . $sourceKey) ?? [])
                //             //         ->filter(fn($choice) => filled($choice))
                //             //         ->unique()
                //             //         ->mapWithKeys(fn($choice) => [$choice => $choice]);

                //             //     $selectedElsewhere = collect($get('../../answer_choices') ?? [])
                //             //         ->pluck('value')
                //             //         ->reject(fn($value) => $value === $get('value'))
                //             //         ->filter()
                //             //         ->all();

                //             //     return $allChoices->except($selectedElsewhere)->all();
                //             // }),
                //             ->options(function (Get $get) {
                //                 $sourceKey = $get('../../question_type') === 'multiple_choice'
                //                     ? 'choices_text'
                //                     : 'choices_math';

                //                 $allChoices = collect($get('../../' . $sourceKey) ?? [])
                //                     ->map(fn($choice) => is_array($choice) ? ($choice['value'] ?? $choice['latex'] ?? null) : $choice)
                //                     ->filter(fn($choice) => filled($choice))
                //                     ->unique()
                //                     ->mapWithKeys(fn($choice) => [$choice => $choice]);

                //                 $selectedElsewhere = collect($get('../../answer_choices') ?? [])
                //                     ->pluck('value')
                //                     ->reject(fn($value) => $value === $get('value'))
                //                     ->filter()
                //                     ->all();

                //                 return $allChoices->except($selectedElsewhere)->all();
                //             }),
                //     ])
                //     ->grid(2)
                //     ->addActionLabel('Add Answer')
                //     ->visible(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math']))
                //     ->dehydrated(fn(Get $get) => in_array($get('question_type'), ['multiple_choice', 'multiple_choice_math'])),
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
