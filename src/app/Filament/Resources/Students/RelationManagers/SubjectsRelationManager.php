<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Filament\Resources\Subjects\SubjectsResource;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'subjects';

    protected static ?string $relatedResource = SubjectsResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // CreateAction::make(),
                AttachAction::make()
                    ->color('gray')->outlined(true)
                    ->label('Attach Subject')->preloadRecordSelect(true)->multiple()
                    ->after(function (array $data) {
                        activity('Subject-User Assignment')
                            ->performedOn($this->getOwnerRecord())
                            ->causedBy(auth()->user())
                            ->withProperties(['attached_ids' => (array) $data['recordId']])
                            ->event('attached')
                            ->log('subject attached');
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DetachAction::make()
                    ->label('Detach')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->after(function (Model $record) {
                        activity('Subject-User Assignment')
                            ->performedOn($this->getOwnerRecord())
                            ->causedBy(auth()->user())
                            ->withProperties(['detached' => $record->only(['id', 'name'])])
                            ->event('detached')
                            ->log('subject detached');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make()
                        ->label('Detach Selected')
                        ->color('danger')
                        ->icon('heroicon-o-x-mark')
                        ->after(function (Collection $records) {
                            activity('Subject-User Assignment')
                                ->performedOn($this->getOwnerRecord())
                                ->causedBy(auth()->user())
                                ->withProperties(['detached_ids' => $records->pluck('id')])
                                ->event('detached')
                                ->log('subject detached');
                        }),
                ])
            ]);
    }
}
