<?php

namespace App\Filament\Resources\Questions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->formatStateUsing(function (string $state) {
                        // 1. Remove common LaTeX wrappers like \( and \)
                        $clean = str_replace(['\(', '\)', '\[', '\]', '$'], '', $state);

                        // 2. Remove common commands (like \frac{...}{...} -> ...) 
                        // This is a basic regex to strip backslashes and curly braces
                        $clean = preg_replace('/\\\[a-z]+|[{}]/', ' ', $clean);

                        // 3. Clean up extra spaces
                        return Str::squish($clean);
                    })
                    ->searchable()
                    ->sortable()
                    ->limit(25)
                    ->tooltip(function (TextColumn $column) {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // 1. Remove common LaTeX wrappers like \( and \)
                        $clean = str_replace(['\(', '\)', '\[', '\]', '$'], '', $state);

                        // 2. Remove common commands (like \frac{...}{...} -> ...) 
                        // This is a basic regex to strip backslashes and curly braces
                        $clean = preg_replace('/\\\[a-z]+|[{}]/', ' ', $clean);

                        // 3. Clean up extra spaces
                        return Str::squish($clean);
                    }),
                TextColumn::make('answer')
                    ->formatStateUsing(function (string $state) {
                        // 1. Remove common LaTeX wrappers like \( and \)
                        $clean = str_replace(['\(', '\)', '\[', '\]', '$'], '', $state);

                        // 2. Remove common commands (like \frac{...}{...} -> ...) 
                        // This is a basic regex to strip backslashes and curly braces
                        $clean = preg_replace('/\\\[a-z]+|[{}]/', ' ', $clean);

                        // 3. Clean up extra spaces
                        return Str::squish($clean);
                    })
                    ->searchable()
                    ->sortable()
                    ->limit(25)
                    ->tooltip(function (TextColumn $column) {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // 1. Remove common LaTeX wrappers like \( and \)
                        $clean = str_replace(['\(', '\)', '\[', '\]', '$'], '', $state);

                        // 2. Remove common commands (like \frac{...}{...} -> ...) 
                        // This is a basic regex to strip backslashes and curly braces
                        $clean = preg_replace('/\\\[a-z]+|[{}]/', ' ', $clean);

                        // 3. Clean up extra spaces
                        return Str::squish($clean);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('subject.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gradeLvl.grade_lvl')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('domain.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('topic.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('skill.name')
                    ->searchable()
                    ->sortable(),
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
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
