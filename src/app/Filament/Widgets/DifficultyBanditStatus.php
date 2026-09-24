<?php

namespace App\Filament\Widgets;

use App\Http\Controllers\DifficultyBanditController;
use App\Models\DifficultyBanditInteractions;
use App\Models\DifficultyBanditRefitLog;
use Filament\Widgets\Widget;
use Livewire\Attributes\Computed;

class DifficultyBanditStatus extends Widget
{
    protected string $view = 'filament.widgets.difficulty-bandit-status';

    protected static ?string $pollingInterval = '1s';

    #[Computed]
    public function banditRefitIsRunning(): bool
    {
        return DifficultyBanditRefitLog::latest()->first()?->status === 'running';
    }

    #[Computed]
    public function banditRefitFailed(): bool
    {
        return DifficultyBanditRefitLog::latest()->first()?->status === 'failed';
    }

    #[Computed]
    public function banditIsFitted(): bool
    {
        return DifficultyBanditRefitLog::all()->isNotEmpty();
    }

    #[Computed]
    public function latestLog()
    {
        return DifficultyBanditRefitLog::latest()->first();
    }

    #[Computed]
    public function banditInteractionsIsSufficient(): bool
    {
        return DifficultyBanditInteractions::count() >= 300;
    }

    #[Computed]
    public function banditInteractionCount(): int
    {
        return DifficultyBanditInteractions::count();
    }

    public function getStatusColor(): string
    {
        if ($this->banditRefitIsRunning) {
            return 'warning';
        }

        if ($this->banditRefitFailed) {
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
        // if ($this->banditRefitIsRunning) {
        //     return 'Refit in Progress';
        // }

        // if ($this->banditRefitFailed) {
        //     return 'Refit Failed';
        // }

        if (!$this->banditIsFitted) {
            return 'Difficulty Bandit not Fitted';
        }

        if (!$this->banditInteractionsIsSufficient) {
            return 'Insufficient Bandit Interactions';
        }

        return match ($this->latestLog?->status) {
            'running' => 'Difficulty Bandit Refit in Progress',
            'success' => 'Difficulty Bandit Refit Success',
            'failed' => 'Difficulty Bandit Refit Failed',
            default => 'No Runs Yet',
        };
    }

    public function startDifficultyBanditRefit(): void
    {
        if ($this->banditRefitIsRunning()) {
            return;
        }

        app(DifficultyBanditController::class)->refitDifficultyBandit();
    }
}
