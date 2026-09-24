<?php

namespace App\Filament\Widgets;

use App\Http\Controllers\BktController;
use App\Models\BktSkillParams;
use App\Models\BktTrainingLog;
use App\Models\MasteryBatchUpdateLog;
use App\Models\MasteryRecords;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Livewire\Attributes\Computed;

class MasteryUpdateStatus extends Widget
{
    protected string $view = 'filament.widgets.mastery-update-status';

    protected static ?string $pollingInterval = '1s';

    #[Computed]
    public function bktTrainingIsRunning(): bool
    {
        return BktTrainingLog::latest()->first()?->status === 'running';
    }

    #[Computed]
    public function bktTrainingFailed(): bool
    {
        return BktTrainingLog::latest()->first()?->status === 'failed';
    }

    #[Computed]
    public function bktIsTrained(): bool
    {
        return BktSkillParams::all()->isNotEmpty();
    }

    #[Computed]
    public function masteryIsInitialized(): bool
    {
        return MasteryRecords::all()->isNotEmpty();
    }

    public function batchUpdateIsRunning(): bool
    {
        return MasteryBatchUpdateLog::latest()->first()?->status === 'running';
    }

    #[Computed]
    public function latestLog()
    {
        if ($this->bktTrainingIsRunning()) {
            return BktTrainingLog::latest()->first();
        } else {
            return MasteryBatchUpdateLog::latest()->first();
        }
    }

    public function getStatusColor(): string
    {
        if ($this->bktTrainingIsRunning) {
            return 'warning';
        }

        if ($this->bktTrainingFailed) {
            return 'danger';
        }

        return match ($this->latestLog?->status) {
            'running' => 'warning',
            'success' => 'success',
            'failed' => 'danger',
            default => 'gray',
        };
    }

    public function getStatusLabel(): string
    {
        if ($this->bktTrainingIsRunning) {
            return 'BKT is Training';
        }

        if ($this->bktTrainingFailed) {
            return 'BKT Training Failed';
        }

        if (!$this->bktIsTrained) {
            return 'BKT Not Trained';
        }

        if ($this->bktIsTrained() && !$this->masteryIsInitialized) {
            return 'No Mastery Records';
        }

        return match ($this->latestLog?->status) {
            'running' => 'Mastery Batch Update Running',
            'success' => 'Mastery Batch Update Success',
            'failed' => 'Mastery Batch Update Failed',
            default => 'No Runs Yet',
        };
    }

    public function startBatchUpdate(): void
    {
        if ($this->batchUpdateIsRunning()) {
            return;
        }

        app(BktController::class)->updateMasteryRecords();
    }

    public function startBktTraining(): void
    {
        if ($this->bktTrainingIsRunning()) {
            return;
        }

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
            ->title("BKT Training Started!")
            ->success()
            ->send();
    }

    public function initializeMasteries(): void
    {
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
    }
}
