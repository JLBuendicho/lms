<?php

use Livewire\Component;
use App\Services\StudentBktService;
use App\Models\MasteryRecords;
use App\Models\Skills;
use App\Models\Topics;

new class extends Component
{
    public int $topicId = 1;
    public int $studentId;
    private $skills;
    private array $skillMasteries = [];

    public function boot(StudentBktService $studentBktService)
    {
        $this->skills = Skills::where('topic_id', $this->topicId)->get();

        foreach ($this->skills as $skill) {
            $this->skillMasteries[] = (MasteryRecords::where('user_id', $this->studentId)
                ->where('skill_id', $skill->id)
                ->value('mastery') ?? 0) * 100;
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
            'datasets' => [[
                'label' => 'Average Mastery %',
                'data' => $this->skillMasteries,
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