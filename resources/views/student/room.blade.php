<x-layout>
    <x-container>
        @student
            <x-write-feedback :room="$room"></x-write-feedback>
            <x-room-details :room="$room"></x-room-details>
        @else
            <div class="flex">
                <div class="w-full md:w-1/2">
                    <p>
                        Student Name: <x-text-bold>{{$user->name}}</x-text-bold>
                    </p>
                    <p>
                        Student #: <x-text-bold>{{$user->student_number}}</x-text-bold>
                    </p>
                    <p>
                        Address : <x-text-bold>{{$user->address}}</x-text-bold>
                    </p>
                    <p>
                        Phone #: <x-text-bold>{{$user->phone}}</x-text-bold>
                    </p>
                </div>
                @if ($user->parent()->count())
                    <div class="w-full md:w-1/2">
                        <p>
                            Parent Name: <x-text-bold>{{$user->parent->parent->name}}</x-text-bold>
                        </p>
                        <p>
                            Phone #: <x-text-bold>{{$user->parent->parent->phone}}</x-text-bold>
                        </p>
                    </div>
                @endif
            </div>
        @endstudent
        <div class="mt-4">
            <x-room-subjects :subjects="$room->subjects" :user-id="$user->id"></x-room-subjects>
        </div>
        @parent
        @else
        <div class="mt-4">
            <x-text-bold>
                Feedbacks ({{$room->feedback()->whereUserId($user->id)->whereNull('reply_to_feedback_id')->count()}})
            </x-text-bold>
            <div class="border-r-2 pr-2">
                <x-feedback :room="$room" :feedback="$room->feedback()->whereNull('reply_to_feedback_id')->whereUserId($user->id)->latest()->get()"></x-feedback>
            </div>
        </div>
        @endparent
    </x-container>
</x-layout>
