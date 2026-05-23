<?php

namespace App\Filament\Widgets;

use App\Models\Domains;
use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\Skills;
use App\Models\Subjects;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class StudentSubjectMasteryChart extends ChartWidget
{
    protected int | string | array $columnSpan = 1;

    public int $subjectId = 1;

    public int $studentId = 7;

    protected int $domainCount;

    public function getHeading(): string|Htmlable|null
    {
        $subjectName = Subjects::where('id', $this->subjectId)->value('name') ?? 'Unknown Subject';

        return 'Average Skill Masteries for ' . $subjectName;
    }

    protected function getData(): array
    {
        $domainIds = Domains::where('subject_id', $this->subjectId)->pluck('id')->toArray();

        $this->domainCount = count($domainIds);

        $domainMasteries = [];
        foreach ($domainIds as $domainId) {
            $domainSkillWeights = QuestionResponse::where('user_id', $this->studentId)
                ->whereRelation('skill.topic', 'domain_id', $domainId)
                ->selectRaw('skill_name, COUNT(*) as attempt_count')
                ->groupBy('skill_name')->pluck('attempt_count', 'skill_name')->toArray();

            $domainSkills = Skills::whereRelation('topic', 'domain_id', $domainId)->pluck('name')->toArray();
            $studentSkillMasteries = [];
            foreach ($domainSkills as $skill) {
                $studentSkillMasteries[$skill] = MasteryRecords::where('user_id', $this->studentId)
                    ->where('skill_name', $skill)
                    ->value('mastery') ?? 0;
            }
            $totalWeight = array_sum($domainSkillWeights);

            $domainMasteryNumerator = 0;
            foreach ($domainSkills as $skill) {
                $skillWeight = $domainSkillWeights[$skill] ?? 0;
                $skillMastery = $studentSkillMasteries[$skill] ?? 0;
                $domainMasteryNumerator += ($skillWeight * $skillMastery);
            }

            $domainMasteries[] = $totalWeight > 0 ? $domainMasteryNumerator / $totalWeight : 0;
        }

        return [
            'labels' => Domains::whereIn('id', $domainIds)->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Average Mastery %',
                    'data' => $domainMasteries,
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
        $count = Domains::where('subject_id', $this->subjectId)->count();
        return $count <= 2 ? 'bar' : 'radar';
    }
}
