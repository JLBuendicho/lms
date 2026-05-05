<?php

namespace App\Filament\Resources\LearningMaterials\Schemas;

use App\Models\Domains;
use App\Models\GradeLvls;
use App\Models\Skills;
use App\Models\Subjects;
use App\Models\Topics;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LearningMaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('content_audio_visual_path')
                    ->label('Audio Visual Material')
                    ->disk('public')
                    ->directory('learning_materials/audio_visuals'),
                RichEditor::make('content')
                    ->label('Material')
                    ->extraInputAttributes([
                        'style' => 'max-height: 400px; overflow-y: auto;',
                    ])
                    ->columnSpanFull(),
                FileUpload::make('attachments')
                    ->multiple()
                    ->disk('public')
                    ->directory('learning_materials/attachments')
                    ->storeFileNamesIn('attachment_file_names'),
                Section::make('Material Information')->schema([
                    Select::make('subject_id')
                        ->live()
                        ->label('Subject')
                        ->options(Subjects::query()->pluck('name', 'id')),
                    Select::make('grade_lvl_id')
                        ->live()
                        ->label('Grade Level')
                        ->options(GradeLvls::query()->pluck('grade_lvl', 'id')),
                    Select::make('domain_id')
                        ->live()
                        ->label('Domain')
                        ->disabled(fn(Get $get) => blank($get('grade_lvl_id')))
                        ->options(fn(Get $get) => Domains::query()
                            ->whereHas(
                                'gradeLvls',
                                fn($query) => $query->where('grade_lvls_id', $get('grade_lvl_id'))
                            )->pluck('name', 'id')),
                    Select::make('topic_id')
                        ->live()
                        ->label('Topic')
                        ->disabled(fn(Get $get) => blank($get('domain_id')))
                        ->options(
                            fn(Get $get) => Topics::query()
                                ->where('domain_id', $get('domain_id'))
                                ->pluck('name', 'id')
                        ),
                    Select::make('skill_id')
                        ->live()
                        ->label('Skill')
                        ->disabled(fn(Get $get) => blank($get('topic_id')))
                        ->options(
                            fn(Get $get) => Skills::query()
                                ->where('topic_id', $get('topic_id'))
                                ->pluck('name', 'id')
                        ),
                ])->columnSpanFull(),
            ]);
    }
}
