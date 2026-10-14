<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Override;

class DismissedStudents extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.dismissed-students';

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
                    ->schema([
                        TextInput::make('confirmation')
                            ->label('Type REASSIGN to confirm')
                            ->required()
                            ->rule('in:REASSIGN'),
                    ])
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->update(['is_dismissed' => false]);
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
                    ->schema([
                        TextInput::make('confirmation')
                            ->label('Type REENROLL to confirm')
                            ->required()
                            ->rule('in:REENROLL'),
                    ])
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->update(['is_dismissed' => false, 'assigned_instructor_id' => null]);
                    })
                    ->after(function () {
                        // return redirect(url());
                    })->color('primary')->icon('heroicon-o-arrow-path'),
            ]);
    }
}
