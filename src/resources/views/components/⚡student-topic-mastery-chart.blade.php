<?php

use Livewire\Component;
use App\Services\StudentBktService;
use App\Models\MasteryRecords;
use App\Models\Skills;
use App\Models\Topics;

new class extends Component {
    public int $topicId = 1;
    public string $subjectColor = 'red';
    public int $studentId;
    private $skills;
    private array $skillMasteries = [];
    private array $colorThemes = [
        'default' => [
            'backgroundColor' => 'rgba(255, 99, 132, 0.45)',
            'borderColor' => 'rgba(255, 99, 132, 1)',
            'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
            'pointHoverBorderColor' => 'rgba(255, 99, 132, 1)',
        ],
        'red' => [
            'backgroundColor' => 'rgba(255, 99, 132, 0.45)',
            'borderColor' => 'rgba(255, 99, 132, 1)',
            'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
            'pointHoverBorderColor' => 'rgba(255, 99, 132, 1)',
        ],
        'emerald' => [
            'backgroundColor' => 'rgba(16, 185, 129, 0.45)',
            'borderColor' => 'rgba(16, 185, 129, 1)',
            'pointBackgroundColor' => 'rgba(16, 185, 129, 1)',
            'pointHoverBorderColor' => 'rgba(16, 185, 129, 1)',
        ],
        'blue' => [
            'backgroundColor' => 'rgba(59, 130, 246, 0.45)',
            'borderColor' => 'rgba(59, 130, 246, 1)',
            'pointBackgroundColor' => 'rgba(59, 130, 246, 1)',
            'pointHoverBorderColor' => 'rgba(59, 130, 246, 1)',
        ],
        'amber' => [
            'backgroundColor' => 'rgba(251, 191, 36, 0.45)',
            'borderColor' => 'rgba(251, 191, 36, 1)',
            'pointBackgroundColor' => 'rgba(251, 191, 36, 1)',
            'pointHoverBorderColor' => 'rgba(251, 191, 36, 1)',
        ],
        'violet' => [
            'backgroundColor' => 'rgba(139, 92, 246, 0.45)',
            'borderColor' => 'rgba(139, 92, 246, 1)',
            'pointBackgroundColor' => 'rgba(139, 92, 246, 1)',
            'pointHoverBorderColor' => 'rgba(139, 92, 246, 1)',
        ],
    ];

    public function boot(StudentBktService $studentBktService)
    {
        $this->skills = Skills::where('topic_id', $this->topicId)->get();

        foreach ($this->skills as $skill) {
            $this->skillMasteries[] = (MasteryRecords::where('user_id', $this->studentId)->where('skill_id', $skill->id)->value('mastery') ?? 0) * 100;
        }
    }

    public function getHeading(): string
    {
        $topicName = Topics::where('id', $this->topicId)->value('name') ?? 'Unknown domain';
        return 'Average Masteries for ' . $topicName;
    }

    public function getChartType(): string
    {
        $count = Skills::where('topic_id', $this->topicId)->count();
        return $count <= 2 ? 'bar' : 'radar';
    }

    public function getChartData(): array
    {
        return [
            'labels' => $this->skills->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Average Mastery %',
                    'data' => $this->skillMasteries,
                    'backgroundColor' => $this->colorThemes[$this->subjectColor]['backgroundColor'],
                    'borderColor' => $this->colorThemes[$this->subjectColor]['borderColor'],
                    'borderWidth' => 1,
                    'pointBackgroundColor' => $this->colorThemes[$this->subjectColor]['pointBackgroundColor'],
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => $this->colorThemes[$this->subjectColor]['pointHoverBorderColor'],
                ],
            ],
        ];
    }
};
?>

<div {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200 bg-white p-2 shadow-sm w-full']) }}
    x-data="{
        init() {
            new Chart(this.$refs.canvas, {
                type: '{{ $this->getChartType() }}',
                data: {{ Js::from($this->getChartData()) }},
                options: {
                    scales: {
                        r: {
                            min: 0,
                            max: 100,
                            beginAtZero: true, // Optional, ensures zero is included
                            ticks: {stepSize: 20},
                        }
                    },
                    responsive: true,
                }
            })
        }
    }">
    <h2 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
        {{ $this->getHeading() }}
    </h2>
    <canvas x-ref="canvas"></canvas>
</div>
