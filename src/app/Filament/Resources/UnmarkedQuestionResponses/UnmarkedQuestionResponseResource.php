<?php

namespace App\Filament\Resources\UnmarkedQuestionResponses;

use App\Filament\Resources\UnmarkedQuestionResponses\Pages\ListUnmarkedQuestionResponses;
use App\Filament\Resources\UnmarkedQuestionResponses\Tables\UnmarkedQuestionResponsesTable;
use App\Models\QuestionResponse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class UnmarkedQuestionResponseResource extends Resource
{
    protected static ?string $model = QuestionResponse::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Unmarked Question Responses';

    protected static ?string $modelLabel = 'Unmarked Question Response';

    protected static ?string $pluralModelLabel = 'Unmarked Question Responses';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('is_validated', false)
            ->whereRelation('user', 'assigned_instructor_id', Auth::user()->id)
            ->with(['question', 'question.subject', 'user'])
            ->selectRaw('MIN(id) as id, user_id, assessment_type, MIN(question_id) as question_id')
            ->groupBy('user_id', 'assessment_type')
            ->orderBy('id', 'asc');
    }

    public static function table(Table $table): Table
    {
        return UnmarkedQuestionResponsesTable::configure($table);
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
            'index' => ListUnmarkedQuestionResponses::route('/'),
            // 'create' => CreateUnmarkedQuestionResponse::route('/create'),
            // 'edit' => EditUnmarkedQuestionResponse::route('/{record}/edit'),
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
