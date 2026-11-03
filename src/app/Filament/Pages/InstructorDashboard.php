<?php
namespace App\Filament\Pages;

use App\Filament\Widgets\DifficultyBanditStatus;
use App\Filament\Widgets\InstructorLeastPerformingStudents;
use App\Filament\Widgets\InstructorTopPerformingStudents;
use App\Filament\Widgets\LmsStatsOverview;
use App\Filament\Widgets\MasteryUpdateStatus;
use App\Filament\Widgets\SkillStatsInstructorOverview;
use App\Filament\Widgets\SkillStatsOverview;
use App\Filament\Widgets\StudentsSubjectToConcernInstructorOverview;
use App\Filament\Widgets\TopPerformingStudentsInstructorOverview;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Override;

class InstructorDashboard extends BaseDashboard
{
    protected static string $routePath = 'instructor';

    #[Override]
    public static function canAccess(): bool
    {
        return auth()->user()->isInstructor();
    }

    // Customize widget columns or override methods here
    public function getColumns(): int | array
    {
        return 2; // Change number of columns
    }

    public function getWidgets(): array
    {
        if (auth()->user()->isRoot()) {
            return [
                LmsStatsOverview::class,
                SkillStatsOverview::class,
                MasteryUpdateStatus::class,
                DifficultyBanditStatus::class,
            ];
        } elseif (auth()->user()->isInstructor()) {
            return [
                SkillStatsInstructorOverview::class,
                // TopPerformingStudentsInstructorOverview::class,
                InstructorTopPerformingStudents::class,
                // StudentsSubjectToConcernInstructorOverview::class,
                InstructorLeastPerformingStudents::class,
            ];
        } else {
            return [];
        }
    }
}
