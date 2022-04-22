<x-new-layout>
    <div class="card-body">
        @if (auth()->user()->type === \App\Models\User::TYPE_STUDENT)
            <div class="row">
                <div class="col-md-12">
                    <x-calendar title="Exams" :data="auth()->user()->dashboardCurrentYearExam()"/>
                </div>
                <x-new-card title="Remaining Exams" value="{{auth()->user()->dashboardRemainingExams()}}" icon="subject"/>
            </div>
        @endif
        @teacher
        <x-card :description="'Created Exam'">
            {{\App\Models\Exam::whereTeacherId(auth()->id())->count()}}
        </x-card>
        @endteacher
        @admin
            <div class="row">
                <div class="col-md-12">
                    <x-calendar
                    :title='"This year`s Examination."'
                    :data="\App\Models\Exam::getExamCurrentYear()"/>
                </div>
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
