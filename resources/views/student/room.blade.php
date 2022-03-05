<x-layout>
    <x-container>
        @student
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
                <div class="w-full md:w-1/2">
                    <p>
                        Parent Name: <x-text-bold>{{$user->parent->parent->name}}</x-text-bold>
                    </p>
                    <p>
                        Phone #: <x-text-bold>{{$user->parent->parent->phone}}</x-text-bold>
                    </p>
                </div>
            </div>
        @endstudent
        <div class="mt-4">
            <x-room-subjects :subjects="$room->subjects" :user-id="$user->id"></x-room-subjects>
        </div>
    </x-container>
</x-layout>
