@props(['activity' => null])
<p>
    <x-text-bold>
        Instructions:
    </x-text-bold>
    {{$activity->instruction}}
</p>
<p>
    <x-text-bold>
        Deadline:
    </x-text-bold>
    {{$activity->deadline->format('M d, Y H:i A')}}
</p>
