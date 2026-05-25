<x-layouts::admin :title="$title ?? 'Marking Assessment'">
    @livewire('unmarked-assessment-response', [
        'userId' => $userId,
        'subjectName' => $subjectName,
        'assessmentType' => $assessmentType
    ])
</x-layouts::admin>