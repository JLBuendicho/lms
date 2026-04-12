<?php

namespace App\Filament\Resources\Subjects;

use App\Filament\Resources\Subjects\Pages\CreateSubjects;
use App\Filament\Resources\Subjects\Pages\EditSubjects;
use App\Filament\Resources\Subjects\Pages\ListSubjects;
use App\Filament\Resources\Subjects\Pages\ManageSubjectDomains;
use App\Filament\Resources\Subjects\Pages\ViewSubjects;
use App\Filament\Resources\Subjects\RelationManagers\DomainsRelationManager;
use App\Filament\Resources\Subjects\Resources\Domains\DomainsResource;
use App\Filament\Resources\Subjects\Schemas\SubjectsForm;
use App\Filament\Resources\Subjects\Schemas\SubjectsInfolist;
use App\Filament\Resources\Subjects\Tables\SubjectsTable;
use App\Models\Subjects;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SubjectsResource extends Resource
{
    protected static ?string $model = Subjects::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Subject Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SubjectsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubjectsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubjectsTable::configure($table);
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
            'index' => ListSubjects::route('/'),
            'create' => CreateSubjects::route('/create'),
            'view' => ViewSubjects::route('/{record}'),
            'edit' => EditSubjects::route('/{record}/edit'),
        ];
    }
}
