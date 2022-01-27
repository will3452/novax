@props(['number' => 1, 'choices' => [], 'qId'=>null])
<div class="rounded-full absolute -top-2 -left-2 w-8 h-8 bg-blue-400 text-white  flex justify-center items-center font-bold">
    {{$number}}
</div>
<div class="p-2 m-2 pt-5 text-lg font-bold tracking-wider">
    {{$slot}}
</div>
<div class="rounded p-2 m-2">
    <div class="font-bold uppercase text-xs">
        Choices:
    </div>
    <div class="flex flex-wrap mt-2">
        @foreach ($choices as $choice)
            <label for="answer_{{$number}}{{$loop->index}}" class="block mr-4 mb-2">
                <input id="answer_{{$number}}{{$loop->index}}" name="answers[{{$number - 1}}]" type="radio" value="{{$qId}}-{{$choice->id}}">
                {{$choice->answer}}
            </label>
        @endforeach
    </div>
</div>
