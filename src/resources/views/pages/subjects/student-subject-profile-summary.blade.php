@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 24px;
        }

        h1,
        h2,
        h3,
        p,
        ul,
        li {
            margin: 0;
        }

        /* ul {
            margin: 0px 0px 8px;
        }

        li {
            margin: 0px 0px 4px;
        } */

        .container {
            width: 100%;
        }

        .profile-details {
            width: 100%;
            padding: 0 16px;
        }

        .proficiency-summary {
            width: 100%;
            padding: 0 16px;
        }

        .masteries-summary {
            width: 100%;
            padding: 0 16px;
        }
    </style>
</head>

<body>

    <h1>{{ $subject->name }} Profile for {{ $user->name }}</h1>
    <hr>

    <div class="container">
        <div class="profile-details">
            <h2>Student Profile</h2>
            <p><strong>LRN:</strong> {{ $user->lrn }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Assigned Instructor:</strong> {{ $user->assignedInstructor->name }}</p>
        </div>
        <hr>
        <div class="proficiency-summary">
            <h2>Proficiency Summary</h2>
            <p><strong>Initial Proficiency:</strong>
                {{ $user->initial_proficiency_lvls && $user->initial_proficiency_lvls[$subject->id] ? ucwords(str_replace('_', ' ', $user->initial_proficiency_lvls[$subject->id])) : '--' }}</p>
            <p><strong>Middle Proficiency:</strong>
                {{ $user->middle_proficiency_lvls && $user->middle_proficiency_lvls[$subject->id] ? ucwords(str_replace('_', ' ', $user->middle_proficiency_lvls[$subject->id])) : '--' }}</p>
            <p><strong>Final Proficiency:</strong>
                {{ $user->final_proficiency_lvls && $user->final_proficiency_lvls[$subject->id] ? ucwords(str_replace('_', ' ', $user->final_proficiency_lvls[$subject->id])) : '--' }}</p>
        </div>
        <hr>
        <div class="masteries-summary">
            <h2>Masteries Summary</h2>
            <p><strong>{{ $subject->name }}:</strong>
                {{ number_format($studentBktService->getStudentSubjectMastery($user->id, $subject->id) * 100, 2) }}%
            </p>
            <ul>
                @foreach ($subjectService->getSubjectDomains($subject->id) as $domain)
                    <li><strong>{{ $domain->name }}: </strong>
                        {{ number_format($studentBktService->getStudentDomainMastery($user->id, $domain->id) * 100, 2) }}%
                    </li>
                    <ul>
                        @foreach ($subjectService->getDomainTopics($domain->id) as $topic)
                            <li><strong>{{ $topic->name }}: </strong>
                                {{ number_format($studentBktService->getStudentTopicMastery($user->id, $topic->id) * 100, 2) }}%
                            </li>
                            <ul>
                                @foreach ($subjectService->getTopicSkills($topic->id) as $skill)
                                    <li><strong>{{ $skill->name }}: </strong>
                                        {{ number_format($studentBktService->getStudentSkillMastery($user->id, $skill->id) * 100, 2) }}%
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
        </div>
        <hr>
    </div>

</body>

</html>
