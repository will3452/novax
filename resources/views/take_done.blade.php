<x-layout>
    <x-page-title>
        Your got : {{$score}}
    </x-page-title>
    @foreach ($record->answers as $a)
        <div class="my-2 border-2 rounded p-4 {{\App\Models\Question::isCorrect($a->question->id, $a->value) ? 'bg-green-300' : 'bg-red-300'}}">
            <div>
                <span class="font-bold">Question: </span>{{$a->question->question}}
            </div>
            <div>
                <span class="font-bold">Your Answer: </span>{{$a->value}}
            </div>
        </div>
    @endforeach
   <div class="text-center mt-4">
        <a href="/exams" class=" btn btn-sm btn-primary">back to list of exams</a>
   </div>
</x-layout>
