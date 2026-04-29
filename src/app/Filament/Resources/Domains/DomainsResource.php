<?php

namespace App\Filament\Resources\Domains;

use App\Filament\Resources\Domains\Pages\CreateDomains;
use App\Filament\Resources\Domains\Pages\EditDomains;
use App\Filament\Resources\Domains\Pages\ListDomains;
use App\Filament\Resources\Domains\Pages\ViewDomains;
use App\Filament\Resources\Domains\RelationManagers\GradeLvlsRelationManager;
use App\Filament\Resources\Domains\Schemas\DomainsForm;
use App\Filament\Resources\Domains\Schemas\DomainsInfolist;
use App\Filament\Resources\Domains\Tables\DomainsTable;
use App\Models\Domains;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DomainsResource extends Resource
{
    protected static ?string $model = Domains::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Subject Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DomainsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DomainsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DomainsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            GradeLvlsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDomains::route('/'),
            'create' => CreateDomains::route('/create'),
            'view' => ViewDomains::route('/{record}'),
            'edit' => EditDomains::route('/{record}/edit'),
        ];
    }
}
