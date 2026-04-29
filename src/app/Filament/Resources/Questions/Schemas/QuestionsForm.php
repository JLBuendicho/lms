<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Forms\Components\MathLiveField;
use App\Models\Domains;
use App\Models\GradeLvls;
use App\Models\Skills;
use App\Models\Subjects;
use App\Models\Topics;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class QuestionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Textarea::make('question')
                //     ->required()
                //     ->columnSpanFull(),
                MathLiveField::make('question')
                    ->label('Question')
                    ->columnSpanFull()
                    ->required(),
                MathLiveField::make('answer')
                    ->label('Answer')
                    ->columnSpanFull(),
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
                        'Initial Assessment' => 'Initial Assessment',
                        'Middle Assessment' => 'Middle Assessment',
                        'Final Assessment' => 'Final Assessment',
                    ]),
            ]);
    }
}
