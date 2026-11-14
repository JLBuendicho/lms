<?php

namespace App\Filament\Resources\Instructors\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class InstructorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("email")
                    ->label("Email")
                    ->searchable()
                    ->sortable(),
                CheckboxColumn::make('is_active')
                    ->label("Active")
                    ->state(fn($record) => !$record->is_dismissed)
                    ->updateStateUsing(function ($record, $state) {
                        $record->update([
                            'is_dismissed' => !$state,
                        ]);
                    })
                    ->disabled(fn() => auth()->user()?->role !== 'root')
                    ->visible(fn() => auth()->user()?->role === 'root'),
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
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->modalHeading('Activate Selected Instructor Accounts')
                        ->modalDescription(
                            'This will Activate the selected instructor accounts.'
                        )
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $activatedCount = 0;

                            foreach ($records as $record) {
                                $record->update(['is_dismissed' => false]);

                                if (!$record->is_dismissed) {
                                    $activatedCount++;
                                }
                            }

                            Notification::make()
                                ->title("{$activatedCount} Instructor Account(s) Activated")
                                ->success()
                                ->body("The selected instructor accounts have been activated.")
                                ->send();
                        })
                        ->color('success')
                        ->icon('heroicon-o-check'),
                    BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->modalHeading('Deactivate Selected Instructor Accounts')
                        ->modalDescription(
                            'This will Deactivate the selected instructor accounts.'
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
                                ->title("{$dismissedCount} Instructor Account(s) Deactivated")
                                ->success()
                                ->body("The selected instructor accounts have been deactivated.")
                                ->send();
                        })
                        ->color('danger')
                        ->icon('heroicon-o-x-mark'),
                ]),
            ]);
    }
}
