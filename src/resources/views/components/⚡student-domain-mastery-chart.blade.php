<?php

use Livewire\Component;
use App\Services\StudentBktService;
use App\Models\Domains;
use App\Models\Topics;

new class extends Component
{
    public int $domainId = 1;
    public int $studentId;
    private $topics;
    private array $topicMasteries = [];

    public function boot(StudentBktService $studentBktService)
    {
        $this->topics = Topics::where('domain_id', $this->domainId)->get();

        foreach ($this->topics as $topic) {
            $this->topicMasteries[] = $studentBktService->getStudentTopicMastery($this->studentId, $topic->id) * 100;
        }
    }

    public function getHeading(): string
    {
        $domainName = Domains::where('id', $this->domainId)->value('name') ?? 'Unknown domain';
        return 'Average Masteries for ' . $domainName;
    }

    public function getChartType(): string
    {
        $count = Topics::where('domain_id', $this->domainId)->count();
        return $count <= 2 ? 'bar' : 'radar';
    }

    public function getChartData(): array
    {

        return [
            'labels' => $this->topics->pluck('name')->toArray(),
            'datasets' => [[
                'label' => 'Average Mastery %',
                'data' => $this->topicMasteries,
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
};
?>

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