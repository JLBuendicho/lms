<?php

namespace App\Filament\Resources\QuestionResponses;

use App\Filament\Resources\QuestionResponses\Pages\EditQuestionResponse;
use App\Filament\Resources\QuestionResponses\Pages\ListQuestionResponses;
use App\Filament\Resources\QuestionResponses\Schemas\QuestionResponseForm;
use App\Filament\Resources\QuestionResponses\Tables\QuestionResponsesTable;
use App\Models\QuestionResponse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class QuestionResponseResource extends Resource
{
    protected static ?string $model = QuestionResponse::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'id';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('is_validated', true)
            ->whereRelation('user', 'assigned_instructor_id', Auth::user()->id)
            ->with(['question', 'question.subject', 'user'])
            ->selectRaw('MIN(id) as id, user_id, assessment_type, MIN(question_id) as question_id')
            ->groupBy('user_id', 'assessment_type')
            ->orderBy('id', 'asc');
    }

    public static function form(Schema $schema): Schema
    {
        return QuestionResponseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionResponsesTable::configure($table);
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
            'index' => ListQuestionResponses::route('/'),
            // 'create' => CreateQuestionResponse::route('/create'),
            'edit' => EditQuestionResponse::route('/{record}/edit'),
        ];
    }

    /**
     * Resource Permissions
     */
    public static function canCreate(): bool
    {
        return Auth::user()->can('mark-question-responses');
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('mark-question-responses');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('mark-question-responses');
    }
}
