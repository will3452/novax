<x-layout>
    <div class="flex flex-wrap">

        @if (auth()->user()->type === \App\Models\User::TYPE_STUDENT)
            <x-card :description="'Exams'">
                {{auth()->user()->totalExams()}}
            </x-card>
            <x-card :description="'Pending'">
                {{auth()->user()->notFinished()}}
            </x-card>

            <x-card :description="'Incoming Examination'">
                {{auth()->user()->incomingExam()}}
            </x-card>
        @else
            <x-card :description="'Created Exam'">
                {{\App\Models\Exam::whereTeacherId(auth()->id())->count()}}
            </x-card>
        @endif

        <x-card :description="'Date Today'">
            {{now()->format('M d, y')}}
        </x-card>
        <x-card :description="'Time'">
            <div x-data="
                {
                        hh:0,
                        mm:0,
                        ss:0,
                        m:'am',
                        init() {
                            setInterval(()=>{
                                let d = new Date();
                                this.hh = `${(d.getHours() % 12)}`.padStart(2, '0');
                                this.mm = `${d.getMinutes()}`.padStart(2, '0');
                                this.ss = `${d.getSeconds()}`.padStart(2, '0');
                                this.m = d.getHours() >= 12 ? 'pm':'am';
                                console.log(1)
                            }, 1000);
                        }
                    }
            ">
                <span x-text="hh"></span>:<span x-text="mm"></span>:<span x-text="ss"></span> <span class="text-xs" x-text="m"></span>
            </div>
        </x-card>
    </div>
    <div>
        <form action="update-password" class="w-10/12" method="POST">
            @csrf
            <div class="form-control">
                <label for="" class="label">
                    <label-text>New Password</label-text>
                </label>
                <input type="password" name="password" class="input input-bordered">
            </div>
            <button class="btn btn-primary mt-4">
                Update Password
            </button>
        </form>
    </div>
</x-layout>
