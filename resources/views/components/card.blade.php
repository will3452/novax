@props(['slot', 'description'])
<div class="p-4 shadow-md w-full md:w-3/12 rounded border-2 border-primary m-1">
    <div class="font-bold text-4xl">
        {{$slot}}
    </div>
    <div class="text-lg">
        {{$description}}
    </div>
</div>
