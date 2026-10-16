<?php

namespace App\Filament\Widgets;

use App\Models\MasteryRecordHistory;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class SkillStatsInstructorOverview extends StatsOverviewWidget
{
    protected function getSkillDeltaMasteryHistory(string $skillName)
    {
        $skillDeltaMasteryHistory = $this->instructorHistoriesQuery()
            ->whereHas('masteryRecord.skill', function ($query) use ($skillName) {
                $query->where('name', $skillName);
            })
            ->orderBy('created_at', 'asc')
            ->take(25)
            ->get()
            ->map(fn($history) => ($history->new_mastery - $history->previous_mastery) * 100);

        // dd($skillDeltaMasteryHistory);

        return $skillDeltaMasteryHistory;
    }

    public function getSubjectDeltaMasteryHistory(string $subjectName)
    {
        $subjectDeltaMasteryHistory = $this->instructorHistoriesQuery()
            ->whereHas('masteryRecord.skill.topic.domain.subject', function ($query) use ($subjectName) {
                $query->where('name', $subjectName);
            })
            ->orderBy('created_at', 'asc')
            ->take(25)
            ->get()
            ->map(fn($history) => ($history->new_mastery - $history->previous_mastery) * 100);

        return $subjectDeltaMasteryHistory;
    }

    protected function instructorHistoriesQuery(): Builder
    {
        $instructor = auth()->user();

        $studentIds = User::query()
            ->where('assigned_instructor_id', $instructor->id)
            ->select('id');

        return MasteryRecordHistory::query()
            ->whereHas('masteryRecord', fn($q) => $q->whereIn('user_id', $studentIds))
            ->whereHas('masteryRecord.skill.topic.domain.subject', function ($q) use ($instructor) {
                // Option A: subjects has an instructor_id column
                // $q->where('subjects.instructor_id', $instructor->id);

                // Option B: many-to-many, e.g. $instructor->subjects()
                $q->whereIn('subjects.id', $instructor->subjects()->select('subjects.id'));
            });
    }

    protected function getStats(): array
    {
        $masteryRecordHistories = $this->instructorHistoriesQuery()
            ->with(['masteryRecord.skill.topic.domain.subject', 'masteryRecord.student'])
            ->get();
        // $masteryRecordHistories = MasteryRecordHistory::with('masteryRecord.skill.topic.domain.subject')->get();
        // dd($masteryRecordHistories[0]);

        $countBySkill = $masteryRecordHistories
            ->groupBy(fn($history) => $history->masteryRecord->skill_name ?? 'Unknown Mastery Record')
            ->map->count();
        $topSkillByCount = $countBySkill
            ->sortDesc()
            ->take(1)
            ->map(fn($count, $skill) => ['skill_name' => $skill, 'count' => $count])
            ->first();
        $averageDeltaBySkill = $masteryRecordHistories
            ->groupBy(fn($history) => $history->masteryRecord->skill_name ?? 'Unknown Mastery Record')
            ->map(fn($histories) => $histories->avg(
                fn($history) => $history->new_mastery - $history->previous_mastery
            ));
        $topSkillByAverageDeltaMastery = $averageDeltaBySkill
            ->sortDesc()
            ->take(1)
            ->map(fn($delta, $skill) => ['skill_name' => $skill, 'avg_delta' => $delta])
            ->first();
        $leastSkillByAverageDeltaMastery = $averageDeltaBySkill
            ->sort()
            ->take(1)
            ->map(fn($delta, $skill) => ['skill_name' => $skill, 'avg_delta' => $delta])
            ->first();

        $generalStats = [
            Stat::make('Most Improved Skill', $topSkillByAverageDeltaMastery['skill_name'] ?? 'N/A')
                ->description(($topSkillByAverageDeltaMastery && $topSkillByAverageDeltaMastery['avg_delta'] !== null) ? 'Average improvement: ' . number_format($topSkillByAverageDeltaMastery['avg_delta'] * 100, 2) . '%' : 'No improvement data available')
                ->descriptionIcon(
                    $topSkillByAverageDeltaMastery ?
                        ($topSkillByAverageDeltaMastery['avg_delta'] > 0 ?
                            'heroicon-m-arrow-trending-up' :
                            'heroicon-m-arrow-trending-down') :
                        null
                )->chart(
                    $topSkillByAverageDeltaMastery ?
                        $this->getSkillDeltaMasteryHistory($topSkillByAverageDeltaMastery['skill_name']) :
                        null
                )->color(
                    $topSkillByAverageDeltaMastery ?
                        ($topSkillByAverageDeltaMastery['avg_delta'] > 0 ?
                            'success' :
                            'danger') :
                        null
                ),
            Stat::make('Least Improved Skill', $leastSkillByAverageDeltaMastery['skill_name'] ?? 'N/A')
                ->description(($leastSkillByAverageDeltaMastery && $leastSkillByAverageDeltaMastery['avg_delta'] !== null) ? 'Average change: ' . number_format($leastSkillByAverageDeltaMastery['avg_delta'] * 100, 2) . '%' : 'No improvement data available')
                ->descriptionIcon(
                    $leastSkillByAverageDeltaMastery ?
                        ($leastSkillByAverageDeltaMastery['avg_delta'] > 0 ?
                            'heroicon-m-arrow-trending-up' :
                            'heroicon-m-arrow-trending-down') :
                        null
                )->chart(
                    $leastSkillByAverageDeltaMastery ?
                        $this->getSkillDeltaMasteryHistory($leastSkillByAverageDeltaMastery['skill_name']) :
                        null
                )->color(
                    $leastSkillByAverageDeltaMastery ?
                        ($leastSkillByAverageDeltaMastery['avg_delta'] > 0 ?
                            'success' :
                            'danger') :
                        null
                ),
            Stat::make('Most Practiced Skill', $topSkillByCount['skill_name'] ?? 'N/A')
                ->description('Practice Count: ' . ($topSkillByCount['count'] ?? 0))
                ->descriptionIcon(
                    $topSkillByCount ?
                        ($topSkillByCount['count'] > 0 ?
                            'heroicon-m-arrow-trending-up' :
                            'heroicon-m-arrow-trending-down') :
                        null
                )->chart(
                    $topSkillByCount ?
                        $this->getSkillDeltaMasteryHistory($topSkillByCount['skill_name']) :
                        null
                )->color(
                    $topSkillByCount ?
                        ($topSkillByCount['count'] > 0 ?
                            'success' :
                            'danger') :
                        null
                ),
        ];

        $averageDeltaBySubject = $masteryRecordHistories
            ->groupBy(fn($history) => $history->masteryRecord?->skill?->topic?->domain?->subject?->name ?? 'Unknown Subject')
            ->map(fn($histories) => $histories->avg(
                fn($history) => $history->new_mastery - $history->previous_mastery
            ));

        $subjectStats = [];
        foreach ($averageDeltaBySubject as $subject => $avgDelta) {
            $subjectStats[] = Stat::make('Average Mastery Change for ' . $subject, number_format($avgDelta * 100, 2) . '%')
                ->description($avgDelta > 0 ? 'Students are showing improvement' : 'Students are declining')
                ->descriptionIcon(
                    $avgDelta > 0 ?
                        'heroicon-m-arrow-trending-up' :
                        'heroicon-m-arrow-trending-down'
                )->chart(
                    $this->getSubjectDeltaMasteryHistory($subject)
                )->color(
                    $avgDelta > 0 ?
                        'success' :
                        'danger'
                );
        }

        $stats = array_merge($generalStats, $subjectStats);

        return $stats;
    }
}
