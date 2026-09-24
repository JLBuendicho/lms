<x-filament-widgets::widget>
    @php
        $banditRefitIsRunning = $this->latestLog ? $this->latestLog->status === 'running' : false;
        $refitButtonDisabled = $banditRefitIsRunning || !$this->banditInteractionsIsSufficient;
    @endphp

    <div wire:key="refit-status-{{ $refitButtonDisabled ? 'static' : 'polling' }}"
        @if ($refitButtonDisabled) wire:poll.1s @endif>
        <x-filament::section>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">Difficulty Bandit Status</h2>

                    @if ($this->latestLog)
                        <p class="text-sm text-gray-500">
                            Run ID: {{ $this->latestLog->id }}
                        </p>
                    @endif

                    @if (!$this->banditInteractionsIsSufficient)
                        <p class="text-sm text-gray-500">
                            Difficulty Bandit Interaction Count
                            <br>Must be atleast 300 to Refit Difficulty Bandit.
                        </p>
                    @endif

                    <p class="text-sm text-gray-500">
                        Difficulty Bandit Interaction Count: {{ $this->banditInteractionCount }}
                    </p>
                </div>

                <x-filament::badge color="{{ $this->getStatusColor() }}">
                    {{ $this->getStatusLabel() }}
                </x-filament::badge>
            </div>

            @if ($this->latestLog)
                <div class="mt-4 space-y-1 text-sm">
                    @if ($this->latestLog->interaction_count)
                        <p><strong>{{ $this->banditIsFitted ? 'Difficulty Bandit Fitted on ' : 'Difficulty Bandit Fitting ' }}
                                {{ $this->latestLog->interaction_count ?? '-' }} Interactions</strong></p>
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
                <x-filament::button color="primary" :disabled="$refitButtonDisabled" wire:click="startDifficultyBanditRefit">
                    @if ($banditRefitIsRunning)
                        <x-filament::loading-indicator size="sm" class="mr-2" />
                        Refitting Difficulty Bandit...
                    @else
                        Refit Difficulty Bandit
                    @endif
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
