<?php

namespace App\Filament\Pages;

use BackedEnum;
use App\Jobs\RestoreBackupJob;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Override;

class Backups extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.backups';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';

    #[Override]
    public static function canAccess(): bool
    {
        return auth()->user()->isRoot();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBackup')
                ->label('Create Backup')
                ->icon('heroicon-o-archive-box-arrow-down')
                ->requiresConfirmation()
                ->action(function () {

                    $exitCode = Artisan::call('backup:run');

                    if ($exitCode === 0) {
                        Notification::make()
                            ->title('Backup created successfully')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Backup failed')
                            ->danger()
                            ->body(Artisan::output())
                            ->send();
                    }
                }),
        ];
    }

    protected function getBackups(): array
    {
        $disk = Storage::disk('local');

        return collect($disk->files('CalauanLMS'))
            ->filter(
                fn(string $file) =>
                str_ends_with($file, '.zip')
            )
            ->map(function (string $file) use ($disk) {
                return [
                    'name' => basename($file),
                    'path' => $file,
                    'size' => $disk->size($file),
                    'created_at' => $disk->lastModified($file),
                ];
            })
            ->sortByDesc('created_at')
            ->values()
            ->all();
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(fn() => $this->getBackups())
            ->columns([
                TextColumn::make('name')
                    ->label('Backup')
                    ->searchable(),

                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(
                        fn($state) => $this->formatBytes($state)
                    ),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y h:i A'),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(array $record) => route(
                        'admin.backups.download',
                        ['backup' => $record['name']]
                    )),
                Action::make('restore')
                    ->label('Restore')
                    ->icon('heroicon-o-arrow-path')
                    ->color('danger')
                    ->modalHeading('Restore Backup')
                    ->modalDescription(
                        'This will replace the current LMS database with the selected backup. '
                            . 'Any data created after this backup may be lost.'
                    )
                    ->schema([
                        TextInput::make('confirmation')
                            ->label('Type RESTORE to confirm')
                            ->required()
                            ->rule('in:RESTORE'),
                    ])
                    ->requiresConfirmation()
                    ->action(function (array $record) {
                        RestoreBackupJob::dispatch(
                            $record['name']
                        );
                    }),
                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Backup')
                    ->modalDescription(
                        'This will permanently delete the selected backup. This action cannot be undone.'
                    )
                    ->action(function (array $record) {
                        $disk = Storage::disk('local');

                        $path = 'CalauanLMS/' . basename($record['name']);

                        if (! $disk->exists($path)) {
                            Notification::make()
                                ->title('Backup not found')
                                ->danger()
                                ->send();

                            return;
                        }

                        $disk->delete($path);

                        Notification::make()
                            ->title('Backup deleted')
                            ->body($record['name'])
                            ->success()
                            ->send();
                    }),
            ]);
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes === 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $i = (int) floor(log($bytes, 1024));

        return round($bytes / (1024 ** $i), 2)
            . ' '
            . $units[$i];
    }
}
