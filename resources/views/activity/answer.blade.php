<x-layout>
    <x-container>
        <x-header>
            {{$activity->name}}
        </x-header>
        <x-timer :rt="$rt"></x-timer>
        <form id="answerForm" action="/submit-answers/{{$activity->id}}" method="POST">

            @csrf
            @foreach ($activity->questions as $q)
            <input type="hidden" name="ques[]" value="{{$q->id}}">
                <div>
                    <div>
                        {{$loop->index + 1}}) {{$q->actual_question}}
                    </div>
                    <div class="pl-4 mt-2 mb-4">
                        @if ($q->type === \App\Models\Question::TYPE_MULTIPLECHOICE)
                        <div class="flex w-full flex-wrap">
                            @foreach ($q->random_choices as $choice)
                                <div class="w-1/2 flex-none">
                                    <input type="radio" value="{{$choice}}" name="ans[{{$q->id}}]">
                                    {{$choice}}
                                </div>
                            @endforeach
                        </div>
                        @else
                        <input type="text" class="border-2 px-2" name="ans[{{$q->id}}]">
                    @endif
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-container>
</x-layout>
