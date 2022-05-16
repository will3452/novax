<x-layout>
    <x-page-title>
        Your got : {{$score}}
    </x-page-title>
    @foreach ($record->answers as $a)
        <div class="my-2 border-2 rounded p-4">
            <div>
                <span class="font-bold">Question: </span>{{$a->question->question}}
            </div>
            <div class="{{\App\Models\Question::isCorrect($a->question->id, $a->question->type === \App\Models\Question::TYPE_MULTIPLE_ANSWER ? explode(',', $a->value) : $a->value) ? 'bg-green-300' : 'bg-red-300'}} p-1">
                <span class="font-bold ">Your Answer: </span>
                @if($a->question->type === \App\Models\Question::TYPE_TRUE_OR_FALSE)
                    {{$a->value ? 'true':'false'}}
                @else
                    {{$a->value}}
                @endif
            </div>
        </div>
    @endforeach
   <div class="text-center mt-4">
        <a href="/exams" class=" btn btn-sm btn-primary">back to list of exams</a>
   </div>
</x-layout>
