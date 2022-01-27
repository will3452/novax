@props(['number' => 1, 'type'=> \App\Models\Answer::TYPE_WRONG, 'answer'=>''])
<div class="rounded-full absolute -top-2 -left-2 w-8 h-8 bg-blue-400 text-white  flex justify-center items-center font-bold">
    {{$number}}
</div>
<div class="p-2 m-2 pt-5 text-lg font-bold tracking-wider">
    {{$slot}}
</div>
<div class="rounded p-2 m-2">
    <div class="font-bold uppercase text-xs">
        Your answer:
        <span class="{{$type === \App\Models\Answer::TYPE_WRONG ? 'text-red-500' : 'text-green-400'}}">
            {{$answer}} <span class="text-xs text-white px-2 rounded {{$type === \App\Models\Answer::TYPE_WRONG ? 'bg-red-500' : 'bg-green-500'}}">{{$type === \App\Models\Answer::TYPE_WRONG ? 'Incorrect' : 'Correct'}}</span>
        </span>
    </div>
</div>
