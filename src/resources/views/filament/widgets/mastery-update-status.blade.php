<x-filament-widgets::widget>
    @php
        $trainBktIsRunning = $this->bktTrainingIsRunning;
        $trainBktButtonDisabled = $trainBktIsRunning;
        $batchUpdateIsRunning = $this->latestLog ? $this->latestLog->status === 'running' : false;
        $updateMasteryButtonDisabled = $batchUpdateIsRunning || !$this->bktIsTrained || !$this->masteryIsInitialized;
    @endphp

    <div wire:key="mastery-status-{{ $updateMasteryButtonDisabled ? 'static' : 'polling' }}"
        @if ($updateMasteryButtonDisabled) wire:poll.1s @endif>
        <x-filament::section>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">BKT Mastery Update Status</h2>

                    @if ($this->latestLog)
                        <p class="text-sm text-gray-500">
                            Run ID: {{ $this->latestLog->id }}
                        </p>
                    @endif

                    @if ($this->bktTrainingIsRunning)
                        <p class="text-sm text-gray-500">
                            BKT Training is currently running.
                            <br>Mastery updates will be disabled until it finishes.
                        </p>
                    @elseif ($this->bktTrainingFailed)
                        <p class="text-sm text-gray-500">
                            BKT Training has failed.
                            <br>Please check the logs for more information.
                            <br>Press Train BKT to try again.
                        </p>
                    @elseif (!$this->bktIsTrained && !$this->masteryIsInitialized)
                        <p class="text-sm text-gray-500">
                            BKT must be trained and
                            <br>Mastery Records must be initialized to update masteries.
                        </p>
                    @elseif ($this->bktIsTrained && !$this->masteryIsInitialized)
                        <p class="text-sm text-gray-500">
                            Mastery Records must be initialized to update masteries.
                        </p>
                    @endif
                </div>

                <x-filament::badge color="{{ $this->getStatusColor() }}">
                    {{ $this->getStatusLabel() }}
                </x-filament::badge>
            </div>

            @if ($this->latestLog)
                <div class="mt-4 space-y-1 text-sm">
                    @if($this->latestLog->response_count)
                    <p><strong>{{ $this->bktIsTrained ? 'BKT Trained' : 'BKT Training' }} on {{ $this->latestLog->response_count ?? '-' }} Responses</strong></p>
                    @endif
                    <p><strong>Started:</strong> {{ $this->latestLog->started_at ?? '-' }}</p>
                    <p><strong>Finished:</strong> {{ $this->latestLog->finished_at ?? '-' }}</p>

                    @if ($this->latestLog->status === 'failed')
                        <p class="text-red-600">
                            <strong>Error:</strong> {{ $this->latestLog->error }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="m-2 flex w-full justify-end">
                @if (!$this->bktIsTrained)
                    <x-filament::button color="primary" :disabled="$trainBktButtonDisabled" wire:click="startBktTraining">
                        @if ($trainBktIsRunning)
                            <x-filament::loading-indicator size="sm" class="mr-2" />
                            Training BKT...
                        @else
                            Train BKT
                        @endif
                    </x-filament::button>
                @elseif ($this->bktIsTrained && !$this->masteryIsInitialized)
                    <x-filament::button color="primary" wire:click="initializeMasteries">
                        Initialize Masteries
                    </x-filament::button>
                @elseif ($this->bktIsTrained && $this->masteryIsInitialized)
                    <x-filament::button color="primary" :disabled="$updateMasteryButtonDisabled" wire:click="startBatchUpdate">
                        @if ($batchUpdateIsRunning)
                            <x-filament::loading-indicator size="sm" class="mr-2" />
                            Updating Masteries...
                        @else
                            Update Masteries
                        @endif
                    </x-filament::button>
                @endif
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
