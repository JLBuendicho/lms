<?php

namespace App\Filament\Widgets;

use App\Models\MasteryRecordHistory;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\PaginationMode;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class InstructorTopPerformingStudents extends TableWidget
{
    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Top Performing Students')
            ->query(fn (): Builder => $this->topStudentsQuery())
            ->columns([
                TextColumn::make('name')
                    ->label('Student'),

                TextColumn::make('avg_delta')
                    ->label('Average Mastery Change')
                    ->formatStateUsing(fn ($state) => number_format($state * 100, 2) . '%')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger')
                    ->icon(fn ($state) => $state > 0
                        ? 'heroicon-m-arrow-trending-up'
                        : 'heroicon-m-arrow-trending-down'),
            ])
            ->defaultSort('avg_delta', 'desc')
            ->paginated([
                3,
                5,
                10,
                25,
                50,
                'all'
            ])
            ->defaultPaginationPageOption(3)
            ->emptyStateHeading('No mastery history yet');
    }

    protected function topStudentsQuery(): Builder
    {
        $instructor = auth()->user();

        $avgDelta = MasteryRecordHistory::query()
            ->selectRaw('AVG(new_mastery - previous_mastery)')
            ->whereHas('masteryRecord', fn ($q) => $q->whereColumn('mastery_records.user_id', 'users.id'))
            ->whereHas('masteryRecord.skill.topic.domain.subject', function ($q) use ($instructor) {
                $q->whereIn('subjects.id', $instructor->subjects()->select('subjects.id'));
            });

        return User::query()
            ->where('assigned_instructor_id', $instructor->id)
            ->where('is_dismissed', false)
            ->addSelect(['users.*', 'avg_delta' => $avgDelta])
            ->orderByDesc('avg_delta');
    }
}