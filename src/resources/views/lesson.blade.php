@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    @php
        $subject = $skill->topic->domain->subject;
        $progress = $studentBktService->getStudentSkillMastery(auth()->user()->id, $skill->id) * 100;
    @endphp
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $skill->topic->domain->subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $skill->topic->domain->id]) }}">
            {{ $skill->topic->domain->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}">
            {{ $skill->topic->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('skill.learning-materials', ['skillId' => $skill->id]) }}">
            {{ $skill->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('learning-materials.resource', ['skillId' => $skill->id, 'lessonId' => $lesson->id]) }}">
            {{ $lesson->title }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="h-full w-full">
        <flux:card class="w-full h-full flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ $lesson->title }}
            </flux:heading>

            @if ($lesson->content_audio_visual_path)
                <div class="w-full bg-zinc-50 border rounded-xl flex justify-center items-center p-4">
                    <video width="500" controls controlsList="nodownload" class="border rounded-xl">
                        <source src="{{ asset('storage/' . $lesson->content_audio_visual_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            @if ($lesson->content)
                <div class="w-full h-full flex flex-wrap gap-1 p-2 overflow-y-auto bg-zinc-50 border rounded-xl">
                    <div class="html-content prose w-full max-w-none p-4">
                        {!! $lesson->content !!}
                    </div>
                </div>
            @endif

            @if (!empty($lesson->attachments))
                <div class="w-full flex flex-col gap-2 bg-zinc-50 border rounded-xl p-4">
                    <flux:heading size="xl" level="2" class="w-full">
                        Attachments
                    </flux:heading>
                    <div class="w-full flex flex-wrap gap-2">
                        @foreach ($lesson->attachment_file_names as $path => $name)
                            <a href="{{ Storage::disk('public')->url($path) }}" target="_blank"
                                class="bg-blue-400 hover:bg-blue-300 rounded px-2 py-1 transition">
                                {{ $name }}
                            </a><br>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex justify-end items-end px-2">
                <flux:button href="{{ route('skill.learning-materials', ['skillId' => $skill->id]) }}"
                    variant="primary" color="red">
                    Return
                </flux:button>
            </div>
        </flux:card>
    </div>
</x-layouts::subjects>
