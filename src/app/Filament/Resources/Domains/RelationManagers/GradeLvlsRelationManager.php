<?php

namespace App\Filament\Resources\Domains\RelationManagers;

use App\Filament\Resources\GradeLvls\GradeLvlsResource;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class GradeLvlsRelationManager extends RelationManager
{
    protected static string $relationship = 'gradeLvls';

    protected static ?string $relatedResource = GradeLvlsResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // CreateAction::make(),
                AttachAction::make()
                    ->label('Attach Grade Lvl')->preloadRecordSelect(true)->multiple(),
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
