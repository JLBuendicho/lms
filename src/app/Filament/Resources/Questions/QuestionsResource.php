<?php

namespace App\Filament\Resources\Questions;

use App\Filament\Resources\Questions\Pages\CreateQuestions;
use App\Filament\Resources\Questions\Pages\EditQuestions;
use App\Filament\Resources\Questions\Pages\ListQuestions;
use App\Filament\Resources\Questions\Pages\ViewQuestions;
use App\Filament\Resources\Questions\Schemas\QuestionsForm;
use App\Filament\Resources\Questions\Schemas\QuestionsInfolist;
use App\Filament\Resources\Questions\Tables\QuestionsTable;
use App\Models\Questions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuestionsResource extends Resource
{
    protected static ?string $model = Questions::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'question';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return QuestionsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuestionsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuestions::route('/'),
            'create' => CreateQuestions::route('/create'),
            'view' => ViewQuestions::route('/{record}'),
            'edit' => EditQuestions::route('/{record}/edit'),
        ];
    }
}
