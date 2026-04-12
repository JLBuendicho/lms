<?php

namespace App\Filament\Resources\Topics\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class TopicsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make()->schema([
                        TextEntry::make('name'),
                        TextEntry::make('domain.subject.name')
                            ->label('Subject Name'),
                        TextEntry::make('domain.name')
                            ->label('Domain Name'),
                    ]),
                    Section::make()->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
                ]),
                ViewEntry::make('topic_skills_mastery_chart')
                    ->view('filament.resources.topics.widgets.topic-skills-mastery-chart')
                    ->viewData(fn(Model $record) => [
                        'topicId' => $record->id,
                    ]),
            ]);
    }
}
