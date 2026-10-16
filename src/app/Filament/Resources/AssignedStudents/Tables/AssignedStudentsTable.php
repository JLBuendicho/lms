<?php

namespace App\Filament\Resources\AssignedStudents\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssignedStudentsTable
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
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('dismiss')
                    ->label('Dismiss')
                    ->modalHeading('Dismiss Student')
                    ->modalDescription(
                        'This will dismiss this student from your assignmnet. '
                            . 'Only Administrators can re-assign a student.'
                    )
                    ->schema([
                        TextInput::make('confirmation')
                            ->label('Type DISMISS to confirm')
                            ->required()
                            ->rule('in:DISMISS'),
                    ])
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->update(['is_dismissed' => true]);
                    })
                    ->after(function () {
                        // return redirect(url());
                    })->color('danger')->icon('heroicon-o-x-mark'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
