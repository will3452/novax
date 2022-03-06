<x-layout>
    <x-container>
        <x-header>
            My Room
        </x-header>
        <x-room-details :room="$room"></x-room-details>
        <x-students :students="$room->studentRooms"></x-students>
        <x-room-subjects :subjects="$room->subjects"></x-room-subjects>
        <div class="mt-4">
            <x-text-bold>
                Feedbacks ({{$room->feedback()->whereNull('reply_to_feedback_id')->count()}})
            </x-text-bold>
            <div class="border-r-2">
                <x-feedback :room="$room" :feedback="$room->feedback()->whereNull('reply_to_feedback_id')->latest()->get()"></x-feedback>
            </div>
        </div>
    </x-container>
</x-layout>
