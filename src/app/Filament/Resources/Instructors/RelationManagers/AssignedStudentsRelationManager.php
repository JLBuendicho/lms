<?php

namespace App\Filament\Resources\Instructors\RelationManagers;

use App\Filament\Resources\Students\StudentResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class AssignedStudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignedStudents';

    protected static ?string $relatedResource = StudentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // CreateAction::make(),
                Action::make('assignStudent')
                    ->label('Assign Student')
                    ->schema([
                        Select::make('student_id')
                            ->label('Student')
                            ->options(
                                User::query()
                                    ->where('role', 'student')
                                    ->whereNull('assigned_instructor_id')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        User::where('id', $data['student_id'])
                            ->update(['assigned_instructor_id' => $this->getOwnerRecord()->id]);
                    })->color('gray')->outlined(true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('unassign')
                    ->label('Unassign')
                    ->action(function (User $record) {
                        $record->update(['assigned_instructor_id' => null]);
                    })->color('danger')->icon('heroicon-o-x-mark'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('unassign')
                        ->label('Unassign Selected')
                        ->action(function (array $recordIds) {
                            User::whereIn('id', $recordIds)
                                ->update(['assigned_instructor_id' => null]);
                        })->color('danger')->icon('heroicon-o-x-mark'),
                ]),
            ]);
    }
}
