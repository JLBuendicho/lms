<?php

namespace App\Filament\Resources\LearningMaterials\Tables;

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
use Illuminate\Support\Facades\Auth;

class LearningMaterialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('material_type')
                    ->searchable()
                    ->formatStateUsing(fn(string $state) => ucwords(str_replace('_', ' ', $state)))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gradeLvl.grade_lvl')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subject.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('domain.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('topic.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('skill.name')
                    ->searchable()
                    ->sortable(),
                CheckboxColumn::make('is_active')
                    ->label('Active')
                    // ->disabled(!(in_array(Auth::user()->role, ['instructor'])))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                SelectFilter::make('material_type')
                    ->label('Material Type')
                    ->options([
                        'resource' => 'Resource',
                        'flash_card' => 'Flashcard',
                    ])
                    ->multiple()
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                    BulkAction::make('make_active')
                        ->label('Make Active')
                        ->action(function (Collection $records) {
                            $madeActiveCount = 0;
                            foreach ($records as $record) {
                                $record->update(['is_active' => true]);

                                if ($record->is_active) {
                                    $madeActiveCount++;
                                }
                            }

                            Notification::make()
                                ->title("{$madeActiveCount} learning material(s) made active.")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->color('success')
                        ->icon('heroicon-o-check'),
                    BulkAction::make('make_inactive')
                        ->label('Make Inactive')
                        ->action(function (Collection $records) {
                            $madeInactiveCount = 0;
                            foreach ($records as $record) {
                                $record->update(['is_active' => false]);

                                if (!$record->is_active) {
                                    $madeInactiveCount++;
                                }
                            }

                            Notification::make()
                                ->title("{$madeInactiveCount} learning material(s) made inactive.")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->color('danger')
                        ->icon('heroicon-o-x-mark'),
                ]),
            ]);
    }
}
