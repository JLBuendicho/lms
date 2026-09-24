<?php

namespace App\Filament\Widgets;

use App\Models\Subjects;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LmsStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $studentCount = User::where('role', 'student')->count();
        $enrolledCount = User::where('role', 'student')->whereNotNull('assigned_instructor_id')->count();
        $instructorCount = User::where('role', 'instructor')->count();
        $subjectCount = Subjects::count();

        return [
            Stat::make('Total Students', $studentCount),
            Stat::make('Enrolled Students', $enrolledCount),
            Stat::make('Instructors', $instructorCount),
            Stat::make('Subjects', $subjectCount),
        ];
    }
}
