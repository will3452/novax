<x-new-layout>
    <div class="d-flex flex-wrap">
        @if (auth()->user()->type === \App\Models\User::TYPE_STUDENT)
            <x-card :description="'Exams'">
                {{auth()->user()->totalExams()}}
            </x-card>
            <x-card :description="'Pending'">
                {{auth()->user()->notFinished()}}
            </x-card>
        @endif
        @teacher
        <x-card :description="'Created Exam'">
            {{\App\Models\Exam::whereTeacherId(auth()->id())->count()}}
        </x-card>
        @endteacher
        @admin
            Fixing bug
        @endadmin
    </div>
</x-new-layout>
