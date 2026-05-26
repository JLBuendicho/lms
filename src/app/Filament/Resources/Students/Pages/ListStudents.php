<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Filament\Resources\Students\Widgets\MasteryUpdateStatus;
use App\Http\Controllers\BktController;
use App\Models\BktSkillParams;
use App\Models\MasteryBatchUpdateLog;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('Train BKT')
                ->label('Train BKT')
                ->action(function () {
                    $reponse = app(BktController::class)->trainBkt();
                    $data = $reponse->getData(true);

                    if ($data['status'] !== 200) {
                        Notification::make()
                            ->title("Training failed ({$data['status']})")
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title("BKT Skill Paramaters Created!")
                        ->success()
                        ->send();

                    return;
                }),
            Action::make('Initialize Masteries')
                ->label('Initialize Masteries')
                ->action(function () {
                    $response = app(BktController::class)->initMasteries();
                    $data = $response->getData(true);

                    if ($data['status'] !== 200) {
                        Notification::make()
                            ->title($data['body'] ?? "Mastery Initialization failed ({$data['status']})")
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title("Masteries Initialized!")
                        ->success()
                        ->send();

                    return;
                }),
            // Action::make('Update Masteries')
            //     ->label('Update Masteries')
            //     ->disabled(function () {
            //         return MasteryBatchUpdateLog::where('status', 'running')->exists();
            //     })
            //     ->action(function () {
            //         app(BktController::class)->updateMasteryRecords();
            //     })
            //     ->successNotificationTitle('Batch Update of Mastery Records Initiated'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MasteryUpdateStatus::class,
        ];
    }
}
