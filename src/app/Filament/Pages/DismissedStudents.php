<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Override;

class DismissedStudents extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.dismissed-students';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    #[Override]
    public static function canAccess(): bool
    {
        return auth()->user()->isRoot();
    }

    // public function getDismissedStudents()
    // {
    //     $dismissedStudents = User::where('role', 'student')->where('is_dismissed', true)->with('assignedInstructor')->get();

    //     return $dismissedStudents;
    // }

    public function table(Table $table): Table
    {
        return $table
            // ->records(fn() => $this->getDismissedStudents())
            ->query(
                User::query()
                    ->where('role', 'student')
                    ->where('is_dismissed', true)
                    ->with('assignedInstructor')
            )
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
                TextColumn::make("assignedInstructor.name")
                    ->label("Assigned Instructor")
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
                Action::make('reassign')
                    ->label('Reassign')
                    ->modalHeading('Reassign Student')
                    ->modalDescription(
                        'This will reassign this student to its previous instructor. '
                    )
                    // ->schema([
                    //     TextInput::make('confirmation')
                    //         ->label('Type REASSIGN to confirm')
                    //         ->required()
                    //         ->rule('in:REASSIGN'),
                    // ])
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->update(['is_dismissed' => false]);

                        if (!$record->is_dismissed) {
                            Notification::make()
                                ->title('Student reassigned successfully.')
                                ->success()
                                ->body("Student {$record->name} has been reassigned to their previous instructor.")
                                ->send();
                        }

                        else {
                            Notification::make()
                                ->title('Failed to reassign student.')
                                ->danger()
                                ->body("Student {$record->name} could not be reassigned. Please try again.")
                                ->send();
                        }
                    })
                    ->after(function () {
                        // return redirect(url());
                    })->color('warning')->icon('heroicon-o-arrow-path'),
                Action::make('re-enroll')
                    ->label('Re-Enroll')
                    ->modalHeading('Re-Enroll Student')
                    ->modalDescription(
                        'This will re-enroll dismissed student. '
                            . 'Assigned Instructor would be cleared.'
                    )
                    // ->schema([
                    //     TextInput::make('confirmation')
                    //         ->label('Type REENROLL to confirm')
                    //         ->required()
                    //         ->rule('in:REENROLL'),
                    // ])
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->update(['is_dismissed' => false, 'assigned_instructor_id' => null]);

                        if (!$record->is_dismissed) {
                            Notification::make()
                                ->title('Student re-enrolled successfully.')
                                ->success()
                                ->body("Student {$record->name} has been re-enrolled.")
                                ->send();
                        }

                        else {
                            Notification::make()
                                ->title('Failed to re-enroll student.')
                                ->danger()
                                ->body("Student {$record->name} could not be re-enrolled. Please try again.")
                                ->send();
                        }
                    })
                    ->after(function () {
                        // return redirect(url());
                    })->color('primary')->icon('heroicon-o-arrow-path'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('reassign')
                        ->label('Reassign Selected')
                        ->modalHeading('Reassign Selected Students')
                        ->modalDescription(
                            'This will reassign the selected students to their previous instructors. '
                        )
                        // ->schema([
                        //     TextInput::make('confirmation')
                        //         ->label('Type REASSIGN to confirm')
                        //         ->required()
                        //         ->rule('in:REASSIGN'),
                        // ])
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $reassignedCount = 0;

                            foreach ($records as $record) {
                                $record->update(['is_dismissed' => false]);

                                if (!$record->is_dismissed) {
                                    $reassignedCount++;
                                }
                            }

                            Notification::make()
                                ->title("{$reassignedCount} Student(s) reassigned successfully.")
                                ->success()
                                ->body("Selected students have been reassigned to their previous instructors.")
                                ->send();
                        })
                        ->after(function () {
                            // return redirect(url());
                        })->color('warning')->icon('heroicon-o-arrow-path'),
                    BulkAction::make('re-enroll')
                        ->label('Re-Enroll Selected')
                        ->modalHeading('Re-Enroll Selected Students')
                        ->modalDescription(
                            'This will re-enroll the selected students. '
                                . 'Assigned Instructor would be cleared.'
                        )
                        // ->schema([
                        //     TextInput::make('confirmation')
                        //         ->label('Type REENROLL to confirm')
                        //         ->required()
                        //         ->rule('in:REENROLL'),
                        // ])
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $reenrolledCount = 0;

                            foreach ($records as $record) {
                                $record->update(['is_dismissed' => false, 'assigned_instructor_id' => null]);

                                if (!$record->is_dismissed) {
                                    $reenrolledCount++;
                                }
                            }
                            Notification::make()
                                ->title("{$reenrolledCount} Student(s) re-enrolled successfully.")
                                ->success()
                                ->body("Selected students have been re-enrolled.")
                                ->send();
                        })
                        ->after(function () {
                            // return redirect(url());
                        })->color('primary')->icon('heroicon-o-arrow-path'),
                ]),
            ]);
    }
}
