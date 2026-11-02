<?php
use App\Models\Domains;
use App\Models\Subjects;
use App\Services\StudentBktService;
use Livewire\Component;

new class extends Component {
    public int $subjectId = 1;
    public string $subjectColor = 'red';
    public int $studentId;
    private $domains;
    private array $domainMasteries = [];
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
        $this->domains = Domains::where('subject_id', $this->subjectId)->get();

        foreach ($this->domains as $domain) {
            $this->domainMasteries[] = $studentBktService->getStudentDomainMastery($this->studentId, $domain->id) * 100;
        }
    }

    public function getHeading(): string
    {
        $subjectName = Subjects::where('id', $this->subjectId)->value('name') ?? 'Unknown Subject';
        return 'Average Masteries for ' . $subjectName;
    }

    public function getChartType(): string
    {
        $count = Domains::where('subject_id', $this->subjectId)->count();
        return $count <= 2 ? 'bar' : 'radar';
    }

    public function getChartData(): array
    {
        return [
            'labels' => $this->domains->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Average Mastery %',
                    'data' => $this->domainMasteries,
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
}; ?>

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
                            ticks: { stepSize: 20 },
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
