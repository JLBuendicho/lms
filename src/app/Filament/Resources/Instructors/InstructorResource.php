<?php

namespace App\Filament\Resources\Instructors;

use App\Filament\Resources\Instructors\Pages\CreateInstructor;
use App\Filament\Resources\Instructors\Pages\EditInstructor;
use App\Filament\Resources\Instructors\Pages\ListInstructors;
use App\Filament\Resources\Instructors\Pages\ViewInstructor;
use App\Filament\Resources\Instructors\RelationManagers\AssignedStudentsRelationManager;
use App\Filament\Resources\Instructors\Schemas\InstructorForm;
use App\Filament\Resources\Instructors\Schemas\InstructorInfolist;
use App\Filament\Resources\Instructors\Tables\InstructorsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Override;

class InstructorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Instructors';

    protected static ?string $modelLabel = 'Instructor';

    protected static ?string $pluralModelLabel = 'Instructors';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'instructor');
    }

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return InstructorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InstructorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstructorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AssignedStudentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstructors::route('/'),
            'create' => CreateInstructor::route('/create'),
            'view' => ViewInstructor::route('/{record}'),
            'edit' => EditInstructor::route('/{record}/edit'),
        ];
    }

    /**
     * Resource Permissions
     */
    public static function canCreate(): bool
    {
        return Auth::user()->can('manage-instructors');
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('manage-instructors');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('manage-instructors');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('manage-instructors');
    }
}
