<x-new-layout>
    <div class="card-body">
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
            <div class="row">
                <div class="col-md-6">
                    <x-pie
                    title="System Users Populations"
                    :data="[
                        'type' => 'count',
                        'Students' => \App\Models\User::whereType(\App\Models\User::TYPE_STUDENT)->count(),
                        'Teachers' => \App\Models\User::whereType(\App\Models\User::TYPE_TEACHER)->count()
                    ]"/>
                </div>
                <div class="col-md-6">
                    <x-pie
                    title="Students per strands"
                    :data="\App\Models\User::dashboardStudentPerStrand()"/>
                </div>
            </div>
        @endadmin

        @push('styles')
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        @endpush
    </div>
</x-new-layout>
