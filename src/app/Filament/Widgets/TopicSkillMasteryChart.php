<?php

namespace App\Filament\Widgets;

use App\Models\MasteryRecords;
use App\Models\Skills;
use App\Models\Topics;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TopicSkillMasteryChart extends ChartWidget
{
    protected int | string | array $columnSpan = 1;

    public int $topicId = 1;

    private int $skillCount;

    public function getHeading(): string|Htmlable|null
    {
        $topicName = Topics::where('id', $this->topicId)->value('name') ?? 'Unknown Topic';

        return $topicName;
    }

    protected function getData(): array
    {
        $skillIds = Skills::where('topic_id', $this->topicId)
            ->pluck('id')
            ->toArray();

        $this->skillCount = count($skillIds);
        
        $avgSkillMasteries = MasteryRecords::whereIn('skill_id', $skillIds)
            ->groupBy(['skill_id', 'skill_name'])
            ->selectRaw('skill_id, skill_name, (AVG(mastery) * 100) as avg_mastery_percentage')
            ->pluck('avg_mastery_percentage')
            ->toArray();
        
        return [
            'labels' => Skills::whereIn('id', $skillIds)->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Average Mastery %',
                    'data' => $avgSkillMasteries,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.45)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(255, 99, 132, 1)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        if ($this->skillCount <= 2) {
            return 'bar';
        }

        return 'radar';
    }
}
