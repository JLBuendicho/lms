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
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

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
                    ->visible(fn() => !$this->isReadOnly())
                    ->schema([
                        Select::make('student_id')
                            ->label('Student')
                            ->options(
                                User::query()
                                    ->where('role', 'student')
                                    ->whereRelation('subjects', function ($query) {
                                        $query->whereIn('subjects.id', $this->getOwnerRecord()->subjects->pluck('id'));
                                    })
                                    ->whereNull('assigned_instructor_id')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->multiple(),
                    ])
                    ->action(function (array $data) {
                        $assignedCount = 0;
                        foreach ($data['student_id'] as $studentId) {
                            User::where('id', $studentId)
                                ->update(['assigned_instructor_id' => $this->getOwnerRecord()->id]);
                            
                            if (User::where('id', $studentId)->value('assigned_instructor_id') === $this->getOwnerRecord()->id) {
                                $assignedCount++;
                            }
                        }
                        Notification::make()
                            ->title('Students Assigned')
                            ->success()
                            ->body("{$assignedCount} student(s) have been assigned to this instructor.")
                            ->send();
                    })->color('gray')->outlined(true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('unassign')
                    ->label('Unassign')
                    ->visible(fn() => !$this->isReadOnly())
                    ->action(function (User $record) {
                        $record->update(['assigned_instructor_id' => null]);
                    })->color('danger')->icon('heroicon-o-x-mark'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('unassign')
                        ->label('Unassign Selected')
                        ->modalHeading('Unassign Selected Students')
                        ->modalDescription(
                            'This will unassign the selected students from this instructor.'
                        )
                        ->requiresConfirmation()
                        ->visible(fn() => !$this->isReadOnly())
                        ->action(function (Collection $records) {
                            $unassignedCount = 0;
                            foreach ($records as $record) {
                                $record->update(['assigned_instructor_id' => null]);
                                
                                if ($record->assigned_instructor_id === null) {
                                    $unassignedCount++;
                                }
                            }
                            Notification::make()
                                ->title('Students Unassigned')
                                ->success()
                                ->body("{$unassignedCount} student(s) have been unassigned from this instructor.")
                                ->send();
                        })
                        ->color('danger')->icon('heroicon-o-x-mark'),
                ]),
            ]);
    }
}
