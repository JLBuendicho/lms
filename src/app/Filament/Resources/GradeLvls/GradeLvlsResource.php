<?php

namespace App\Filament\Resources\GradeLvls;

use App\Filament\Resources\GradeLvls\Pages\CreateGradeLvls;
use App\Filament\Resources\GradeLvls\Pages\EditGradeLvls;
use App\Filament\Resources\GradeLvls\Pages\ListGradeLvls;
use App\Filament\Resources\GradeLvls\Pages\ViewGradeLvls;
use App\Filament\Resources\GradeLvls\RelationManagers\DomainsRelationManager;
use App\Filament\Resources\GradeLvls\Schemas\GradeLvlsForm;
use App\Filament\Resources\GradeLvls\Schemas\GradeLvlsInfolist;
use App\Filament\Resources\GradeLvls\Tables\GradeLvlsTable;
use App\Models\GradeLvls;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class GradeLvlsResource extends Resource
{
    protected static ?string $model = GradeLvls::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Subject Management';

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'grade_lvl';

    public static function form(Schema $schema): Schema
    {
        return GradeLvlsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GradeLvlsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GradeLvlsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            DomainsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGradeLvls::route('/'),
            'create' => CreateGradeLvls::route('/create'),
            'view' => ViewGradeLvls::route('/{record}'),
            'edit' => EditGradeLvls::route('/{record}/edit'),
        ];
    }
}
