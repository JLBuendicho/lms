<?php

namespace App\Filament\Resources\Students\Tables;

use App\Models\Batch;
use App\Models\Subjects;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("lrn")
                    ->label("Learner Reference Number (LRN)")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("email")
                    ->label("Email")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("batch.batch")
                    ->label("Batch")
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make("subjects.name")
                    ->label("Subjects")
                    // ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("assignedInstructor.name")
                    ->label("Assigned Instructors")
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('batch')
                    ->label('Batch')
                    ->relationship(
                        'batch',
                        'batch',
                        fn ($query) => $query->where('is_active', true),
                    )
                    ->multiple()
                    ->searchable()
                    ->preload(),
                SelectFilter::make('subjects')
                    ->label('Subjects')
                    ->relationship('subjects', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                SelectFilter::make('assigned_instructor_id')
                    ->label('Assigned Instructor')
                    ->options(User::where('role', 'instructor')->pluck('name', 'id'))
                    ->multiple()
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
