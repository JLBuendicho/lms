<?php

namespace App\Filament\Resources\AssignedStudents;

use App\Filament\Resources\AssignedStudents\Pages\CreateAssignedStudent;
use App\Filament\Resources\AssignedStudents\Pages\EditAssignedStudent;
use App\Filament\Resources\AssignedStudents\Pages\ListAssignedStudents;
use App\Filament\Resources\AssignedStudents\Pages\ViewAssignedStudent;
use App\Filament\Resources\AssignedStudents\Schemas\AssignedStudentForm;
use App\Filament\Resources\AssignedStudents\Schemas\AssignedStudentInfolist;
use App\Filament\Resources\AssignedStudents\Tables\AssignedStudentsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssignedStudentResource extends Resource
{
    protected static ?string $model = User::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'My Students';

    protected static ?string $modelLabel = 'My Student';

    protected static ?string $pluralModelLabel = 'My Students';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'student')->where('assigned_instructor_id', Auth::user()->id);
    }

    public static function form(Schema $schema): Schema
    {
        return AssignedStudentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssignedStudentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssignedStudentsTable::configure($table);
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
            'index' => ListAssignedStudents::route('/'),
            'create' => CreateAssignedStudent::route('/create'),
            'view' => ViewAssignedStudent::route('/{record}'),
            'edit' => EditAssignedStudent::route('/{record}/edit'),
        ];
    }
    
    /**
     * Resource Permissions
     */
    public static function canCreate(): bool
    {
        return Auth::user()->can('manage-assigned-students');
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('manage-assigned-students');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('manage-assigned-students');
    }
}
