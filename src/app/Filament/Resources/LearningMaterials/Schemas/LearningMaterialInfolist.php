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
                Section::make('Audio Visual Material')->schema([
                    ViewEntry::make('content_audio_visual_path')
                        ->view('filament.infolists.components.uploaded-video'),
                ]),
                Section::make('Attachments')->schema([
                    ViewEntry::make('attachment_file_names')
                        ->view('filament.infolists.components.downloadable-attachment-entry'),
                ]),
                Section::make('Material')->schema([
                    TextEntry::make('content')
                        ->html()
                        ->extraAttributes([
                            'class' => 'prose max-w-none max-h-[400px] overflow-y-auto p-4',
                        ])
                ])->columnSpanFull(),
                Section::make('Material Information')->schema([
                    TextEntry::make('gradeLvl.grade_lvl')
                        ->numeric()
                        ->placeholder('-'),
                    TextEntry::make('subject.name')
                        ->placeholder('-'),
                    TextEntry::make('domain.name')
                        ->placeholder('-'),
                    TextEntry::make('topic.name')
                        ->placeholder('-'),
                    TextEntry::make('skill.name')
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
