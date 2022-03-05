<x-layout>
    <x-container>
        <x-header>
            My Room
        </x-header>
        <x-room-details :room="$room"></x-room-details>
        <x-students :students="$room->studentRooms"></x-students>
        <x-room-subjects :subjects="$room->subjects"></x-room-subjects>
    </x-container>
</x-layout>
