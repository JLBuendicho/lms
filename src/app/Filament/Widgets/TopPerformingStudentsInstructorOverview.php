<?php

namespace App\Filament\Widgets;

use App\Models\MasteryRecordHistory;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Override;

class TopPerformingStudentsInstructorOverview extends StatsOverviewWidget
{
    #[Override]
    protected function getHeading(): ?string
    {
        return 'Top Performing Students';
    }

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

    public function getStudentDeltaMasteryHistory(string $studentName)
    {
        $studentDeltaMasteryHistory = $this->instructorHistoriesQuery()
            ->whereHas('masteryRecord.student', function ($query) use ($studentName) {
                $query->where('name', $studentName);
            })
            ->orderBy('created_at', 'asc')
            ->take(25)
            ->get()
            ->map(fn($history) => ($history->new_mastery - $history->previous_mastery) * 100);

        return $studentDeltaMasteryHistory;
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

        $topPerformingStudentsByAverageDelta = $masteryRecordHistories
            ->groupBy(fn($history) => $history->masteryRecord?->student?->name ?? 'Unknown Student')
            ->map(fn($histories) => $histories->avg(
                fn($history) => $history->new_mastery - $history->previous_mastery
            ))
            ->sortDesc()
            ->take(3)
            ->map(fn($delta) => $delta);
        // dd($topPerformingStudentsByAverageDelta);

        $topStudentStats = [];
        foreach ($topPerformingStudentsByAverageDelta as $student => $avgDelta) {
            $topStudentStats[] = Stat::make('Average Mastery Change for ', $student)
                ->description('Average change: ' . number_format($avgDelta * 100, 2) . '%')
                ->descriptionIcon(
                    $avgDelta > 0 ?
                        'heroicon-m-arrow-trending-up' :
                        'heroicon-m-arrow-trending-down'
                )->chart(
                    $this->getStudentDeltaMasteryHistory($student)
                )->color(
                    $avgDelta > 0 ?
                        'success' :
                        'danger'
                );
        }


        $studentStats = array_merge($topStudentStats);

        return $studentStats;
    }
}
