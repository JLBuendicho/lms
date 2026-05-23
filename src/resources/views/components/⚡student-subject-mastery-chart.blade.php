<?php
use App\Models\Domains;
use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\Skills;
use App\Models\Subjects;
use App\Services\StudentBktService;
use Livewire\Component;

new class extends Component
{
    public int $subjectId = 1;
    public int $studentId;
    private $domains;
    private array $domainMasteries = [];

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
            'datasets' => [[
                'label' => 'Average Mastery %',
                'data' => $this->domainMasteries,
                'backgroundColor' => 'rgba(255, 99, 132, 0.45)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
                'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
                'pointBorderColor' => '#fff',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgba(255, 99, 132, 1)',
            ]],
        ];
    }
}; ?>

<div
    {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200 bg-white p-2 shadow-sm w-full']) }}
    x-data="{
        init() {
            new Chart(this.$refs.canvas, {
                type: '{{ $this->getChartType() }}',
                data: {{ Js::from($this->getChartData()) }},
                options: {
                    responsive: true,
                }
            })
        }
    }"
>
    <h2 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
        {{ $this->getHeading() }}
    </h2>
    <canvas x-ref="canvas"></canvas>
</div>