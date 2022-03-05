@props(['room'])
<x-section-title>
    Details.
</x-section-title>
<div class="border-dashed border-2 mt-4 p-2">
    <div>
        Name: <x-text-bold>{{$room->name}}</x-text-bold>
    </div>
    <div>
        Year Level: <x-text-bold>{{$room->year_level}}</x-text-bold>
    </div>
    <div>
        Code: <x-text-bold>{{$room->code}}</x-text-bold>
    </div>
    @teacher
    @else
    <div>
        Teacher: <x-text-bold>{{$room->teacher->name}}</x-text-bold>
    </div>
    @endteacher
</div>
