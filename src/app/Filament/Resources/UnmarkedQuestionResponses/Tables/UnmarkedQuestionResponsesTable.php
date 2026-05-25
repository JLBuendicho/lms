<?php

namespace App\Filament\Resources\UnmarkedQuestionResponses\Tables;

use App\Models\Subjects;
use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UnmarkedQuestionResponsesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("question.subject.name")
                    ->label("Subject")
                    ->searchable(),
                    // ->sortable(),
                TextColumn::make("assessment_type")
                    ->label("Assessment Type")
                    ->formatStateUsing(function (string $state) {
                        return ucfirst($state) . ' Assessment';
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make("user.name")
                    ->label("Name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("user.lrn")
                    ->label("Learner Reference Number (LRN)")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("user.email")
                    ->label("Email")
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
                SelectFilter::make('assessment_type')
                    ->label('Assessment Type')
                    ->multiple()
                    ->options([
                        'initial' => 'Initial Assessment',
                        'middle' => 'Middle Assessment',
                        'final' => 'Final Assessment',
                    ]),
                SelectFilter::make('subject')
                    ->relationship('question.subject', 'name')
                    ->label('Subject')
                    ->preload()
                    ->searchable()
                    ->multiple(),
            ])
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
                Action::make('view-unmarked-responses')
                    ->label('View')
                    ->icon('heroicon-s-eye')
                    ->url(fn ($record) => route('question-responses.show', [
                        'subjectName' => lcfirst($record->question->subject->name),
                        'assessmentType' => $record->assessment_type,
                        'userId' => $record->user_id,
                    ])),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
