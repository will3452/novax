<x-app>
    <style>
        .input-choice{
            cursor: pointer;
        }
    </style>
    <x-page-container>
            <!-- Page Heading -->
        <x-page-header>
            {{$exam->description}}
        </x-page-header>
        <div class="row">
            <div class="col-md-8 mb-4">
                <form action="/exams/{{$exam->id}}" method="POST">
                    @csrf
                    @foreach ($exam->questions as $qkey=>$question)
                        <div class="card border-left-warning shadow my-2">
                            <div class="card-body" id="question_{{$question->id}}">
                                <div>
                                    {{$question->value}}
                                </div>
                                <div class="row">
                                    @foreach ($question->answers as $answer)
                                        <div class="col-md-4">
                                            <input type="radio" class="mr-1 input-choice" id="answers_{{$question->id}}" name="answers[{{$qkey}}]" value="{{$answer->id}}_{{$question->id}}">
                                            <label for="answers_{{$question->id}}" class="text-xs align-items-center">
                                                {{$answer->value}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-right">
                        <button class="btn btn-primary btn-sm">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 p-relative d-none d-md-block">
                <div class="card card-body shadow" style="position:fixed; width:300px;">
                    <div class="row">
                        @foreach ($exam->questions as $key=>$q)
                           <div class="col-md-3 my-1">
                                <a class="btn btn-light" href="#question_{{$q->id}}">{{$key+1}}</a>
                           </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-page-container>
</x-app>
