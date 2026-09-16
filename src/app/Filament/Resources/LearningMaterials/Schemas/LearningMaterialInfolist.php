<?php

namespace App\Filament\Resources\LearningMaterials\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LearningMaterialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Material Type')->schema([
                    TextEntry::make('material_type')
                        ->hiddenLabel()
                        ->formatStateUsing(function (string $state): string {
                            $state = str_replace('_',' ', $state);
                            return ucwords($state);
                        }),
                ])->columnSpanFull(),
                Section::make('Audio Visual Material')->schema([
                    ViewEntry::make('content_audio_visual_path')
                        ->view('filament.infolists.components.uploaded-video'),
                ])->visible(fn($record) => $record->material_type !== 'flash_card'),
                Section::make('Attachments')->schema([
                    ViewEntry::make('attachment_file_names')
                        ->view('filament.infolists.components.downloadable-attachment-entry'),
                ])->visible(fn($record) => $record->material_type !== 'flash_card'),
                Section::make('Material')->schema([
                    TextEntry::make('content')
                        ->html()
                        ->extraAttributes([
                            'class' => 'prose max-w-none max-h-[400px] overflow-y-auto p-4',
                        ])
                ])->visible(fn($record) => $record->material_type !== 'flash_card')->columnSpanFull(),
                Section::make('Card Front')->schema([
                    TextEntry::make('content_front')
                        ->html()
                        ->extraAttributes([
                            'class' => 'prose flex flex-col gap-2 max-w-none max-h-[400px] overflow-y-auto p-4',
                        ])
                        ->hiddenLabel(),
                ])->visible(fn($record) => $record->material_type === 'flash_card')->columnSpanFull(),
                Section::make('Card Back')->schema([
                    TextEntry::make('content_back')
                        ->html()
                        ->extraAttributes([
                            'class' => 'prose flex flex-col gap-2 max-w-none max-h-[400px] overflow-y-auto p-4',
                        ])
                        ->hiddenLabel(),
                ])->visible(fn($record) => $record->material_type === 'flash_card')->columnSpanFull(),
                Section::make('Material Information')->schema([
                    TextEntry::make('gradeLvl.grade_lvl')
                        ->numeric()
                        ->label('Grade Level')
                        ->placeholder('-'),
                    TextEntry::make('subject.name')
                        ->label('Subject')
                        ->placeholder('-'),
                    TextEntry::make('domain.name')
                        ->label('Domain')
                        ->placeholder('-'),
                    TextEntry::make('topic.name')
                        ->label('Topic')
                        ->placeholder('-'),
                    TextEntry::make('skill.name')
                        ->label('Skill')
                        ->placeholder('-'),
                ]),
                Section::make('Metadata')->schema([
                    TextEntry::make('created_at')
                        ->dateTime()
                        ->placeholder('-'),
                    TextEntry::make('updated_at')
                        ->dateTime()
                        ->placeholder('-'),
                ]),
            ]);
    }
}
