<x-layout>
    <div class="flex flex-wrap">

        @if (auth()->user()->type === \App\Models\User::TYPE_STUDENT)
            <x-card :description="'Exams'">
                {{auth()->user()->totalExams()}}
            </x-card>
            <x-card :description="'Pending'">
                {{auth()->user()->notFinished()}}
            </x-card>
        @else
            <x-card :description="'Created Exam'">
                {{\App\Models\Exam::whereTeacherId(auth()->id())->count()}}
            </x-card>
        @endif
    </div>
</x-layout>
