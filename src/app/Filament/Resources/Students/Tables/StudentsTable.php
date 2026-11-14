<?php

namespace App\Filament\Resources\Students\Tables;

use App\Models\Batch;
use App\Models\Subjects;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

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
                CheckboxColumn::make('is_active')
                    ->label("Active")
                    ->state(fn ($record) => !$record->is_dismissed)
                    ->updateStateUsing(function ($record, $state) {
                        $record->update([
                            'is_dismissed' => !$state,
                        ]);
                    })
                    ->disabled(fn () => auth()->user()?->role !== 'root')
                    ->visible(fn () => auth()->user()?->role === 'root'),
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
                    BulkAction::make('dismiss')
                        ->label('Deactivate Selected')
                        ->modalHeading('Deactivate Selected Student Accounts')
                        ->modalDescription(
                            'This will Deactivate the selected student accounts. '
                                . 'inactive student accounts are viewable in Dismissed Students.'
                        )
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $dismissedCount = 0;

                            foreach ($records as $record) {
                                $record->update(['is_dismissed' => true]);

                                if ($record->is_dismissed) {
                                    $dismissedCount++;
                                }
                            }

                            Notification::make()
                                ->title("{$dismissedCount} Student Account(s) Deactivated")
                                ->success()
                                ->body("The selected student accounts have been deactivated.")
                                ->send();
                        })
                        ->color('danger')
                        ->icon('heroicon-o-x-mark'),
                ]),
            ]);
    }
}
