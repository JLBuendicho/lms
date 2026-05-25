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
                    ->label('Attach Subject')->preloadRecordSelect(true)->multiple(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DetachAction::make()
                    ->label('Detach')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make()
                        ->label('Detach Selected')
                        ->color('danger')
                        ->icon('heroicon-o-x-mark'),
                ])
            ]);
    }
}
