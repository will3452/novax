`<x-new-layout>
    <x-page-title>
        {{$exam->name}}
    </x-page-title>
    <style>
    </style>
    @teacher
    <div>
        <a href="/questions/create/{{$exam->id}}" class="btn btn-primary">Create New Question</a>
    </div>
    <div class="d-flex justify-between my-4 items-start justify-content-between">
        <div class="tabs">
            <a  href="{{route('exam.show', ['exam' => $exam->id])}}"  class="btn {{route('exam.show', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Questionnaire</a>
            <a  href="{{route('exam.result', ['exam' => $exam->id])}}"  class="btn {{route('exam.result', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Turned In</a>
            <a  href="{{route('exam.graded', ['exam' => $exam->id])}}"  class="btn {{route('exam.graded', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Graded</a>
            <a  href="{{route('exam.nograde', ['exam' => $exam->id])}}"  class="btn {{route('exam.nograde', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Not Yet Graded</a>
            <a  href="{{route('exam.notyet', ['exam' => $exam->id])}}"  class="btn {{route('exam.notyet', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Not Yet Submitting</a>
            <a  href="{{route('exam.report', ['exam' => $exam->id])}}" class="btn {{route('exam.report', ['exam' => $exam->id]) == url()->current() ? 'btn-dark':''}}">Summary</a>
        </div>
    </div>
    @endteacher
    @if (route('exam.show', ['exam' => $exam->id]) == url()->current())
    <div class="card card-body">
        <div class="table-responsive">
            <a class="btn btn-sm btn-success" target="_blank" href="/print-q/{{$exam->id}}">Print/Download questionnaire</a>
            <table class="table">
                <thead>
                    <tr>
                        <th class="long">
                            Question
                        </th>
                        <th class="long">
                            Correct Answer
                        </th>
                        <th class="long">
                            Type
                        </th>
                        <th class="long">
                            Choices
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exam->questions as $q)
                        <tr>
                            <td class="long">
                                @if ($q->question_image)
                                    <a target="_blank" href="{{$q->storage_question}}">
                                        <img src="{{$q->storage_question}}" alt="" style="width:50px !important;">
                                    </a>
                                @else
                                    {{\Str::limit($q->question, 55)}}
                                @endif
                            </td>
                            <td class="long">
                                @if ($q->type === \App\Models\Question::TYPE_MULTIPLE_ANSWER)
                                    @foreach ($q->getAllChoice($q->answer) as $c)
                                        <span>{{$c}}</span>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @elseif($q->type === \App\Models\Question::TYPE_TRUE_OR_FALSE)
                                {{$q->answer ? 'true':'false'}}
                                @else
                                    {{\Str::limit($q->answer, 50)}}
                                @endif
                            </td>
                            <td class="long">
                                {{$q->type}}
                            </td>
                            <td >
                                @foreach ($q->getAllChoice(null) as $c)
                                    <span>{{$c}}</span>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-danger" href="/questions/delete/{{$q->id}}">delete</a>
                                <a class="btn btn-secondary" href="/questions/edit/{{$q->id}}">update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if(route('exam.result', ['exam' => $exam->id]) == url()->current())
    <div class="card card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Date (mm/dd/yy hh:mm)
                    </th>
                    <th>
                        Student
                    </th>
                    <th>
                        Strand
                    </th>
                    <th>
                        Score
                    </th>
                    <th>
                        Screen Rec.
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            @foreach ($exam->records as $i)
                <tr>
                    <td>
                        {{$i->updated_at->format('m/d/y h:i a')}}
                    </td>
                    <td>
                        <img src="{{$i->user->getPicture()}}" alt="" class="avatar avatar-sm me-3 border-radius-lg">
                        {{$i->user->name}} - {{$i->user->number}}
                    </td>
                    <td>
                        {{$i->user->strand}}
                    </td>
                    <td>
                        {{$i->score}}
                    </td>
                    <td>
                        <a href="/storage/{{$i->screen_record}}" target="_blank" class="btn btn-xs btn-primary">watch</a>
                    </td>
                    <td>
                        @if ($exam->is_manual_checking)
                           <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal{{$exam->id}}">View answer</button>
                           <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$exam->id}}" role="dialog">
                                <div class="modal-dialog">
                                    <form action="{{route('update.grade.of.record', ['record' => $i->id])}}" method="POST" class="modal-content modal-body">
                                        @csrf
                                           @foreach ($i->answers as $a)
                                               <div class="mb-2  p-2 border border-dashed border-2 break-all">
                                                <div class="bg-base-200 p-2 rounded mb-2">
                                                    <span class="font-bold block">
                                                        Question/Instruction:
                                                    </span>
                                                    <div class="text-wrap text-sm mt-3">
                                                        {{$a->question->question}}
                                                    </div>
                                                </div>
                                                <div class="bg-base-200 p-2 rounded">
                                                    <span class="font-bold block">Answer:</span>
                                                    <div class="text-xs overflow-x-auto">
                                                        {{$a->value}}
                                                    </div>
                                                </div>
                                                <div class="form-control">
                                                    <label for="" class="label"><span class="label-text">Enter Score: </span></label>
                                                    <input type="text" name="status[]" class="input input-bordered input-sm w-full">
                                                </div>
                                               </div>
                                           @endforeach
                                           <button class="btn w-full btn-primary">
                                               Submit
                                           </button>
                                       </form>
                                </div>
                           </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif

    @if(route('exam.graded', ['exam' => $exam->id]) == url()->current())
    @if (count($records) || true)
        <a href="/extract-excel/{{$exam->id}}" class="btn btn-sm btn-success">Extract as Excel file</a>
    @endif
    <div class="card card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>
                        Date (mm/dd/yy hh:mm)
                    </th>
                    <th>
                        Student
                    </th>
                    <th>
                        Score
                    </th>
                </tr>
            </thead>
            @foreach ($records as $i)
                <tr>
                    <td>
                        {{$i->updated_at->format('m/d/y h:i a')}}
                    </td>
                    <td>
                        <img src="{{$i->user->getPicture()}}" alt="" class="avatar avatar-sm me-3 border-radius-lg">
                        {{$i->user->name}} - {{$i->user->number}}
                    </td>
                    <td>
                        {{$i->score}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif

    @if(route('exam.notyet', ['exam' => $exam->id]) == url()->current())
    <div class="card card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Student
                    </th>
                </tr>
            </thead>
            @foreach ($records as $i)
                <tr>
                    <td>
                        <img src="{{$i->getPicture()}}" alt="" class="avatar avatar-sm me-3 border-radius-lg">
                        {{$i->name}} - {{$i->number}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif

    @if(route('exam.nograde', ['exam' => $exam->id]) == url()->current())
    <div class="card card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Date (mm/dd/yy hh:mm)
                    </th>
                    <th>
                        Student
                    </th>
                    <th>
                        Screen Rec.
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            @foreach ($records as $i)
                <tr>
                    <td>
                        {{$i->updated_at->format('m/d/y h:i a')}}
                    </td>
                    <td>
                        <img src="{{$i->user->getPicture()}}" alt="" class="avatar avatar-sm me-3 border-radius-lg">
                        {{$i->user->name}} - {{$i->user->number}}
                    </td>
                    <td>
                        <a href="/storage/{{$i->screen_record}}" target="_blank" class="btn btn-xs btn-primary">watch</a>
                    </td>
                    <td>
                        @if ($exam->is_manual_checking)
                           <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal{{$exam->id}}">View answer</button>
                           <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$exam->id}}" role="dialog">
                                <div class="modal-dialog">
                                    <form action="{{route('update.grade.of.record', ['record' => $i->id])}}" method="POST" class="modal-content modal-body">
                                        @csrf
                                           @foreach ($i->answers as $a)
                                               <div class="mb-2  p-2 border border-dashed border-2 break-all">
                                                <div class="bg-base-200 p-2 rounded mb-2">
                                                    <span class="font-bold block">
                                                        Question/Instruction:
                                                    </span>
                                                    <div class="text-wrap text-sm mt-3">
                                                        {{$a->question->question}}
                                                    </div>
                                                </div>
                                                <div class="bg-base-200 p-2 rounded">
                                                    <span class="font-bold block">Answer:</span>
                                                    <div class="text-xs overflow-x-auto">
                                                        {{$a->value}}
                                                    </div>
                                                </div>
                                                <div class="form-control">
                                                    <label for="" class="label"><span class="label-text">Enter Score: </span></label>
                                                    <input type="text" name="status[]" class="input input-bordered input-sm w-full">
                                                </div>
                                               </div>
                                           @endforeach
                                           <button class="btn w-full btn-primary">
                                               Submit
                                           </button>
                                       </form>
                                </div>
                           </div>
                        @endif
                    </td>

                </tr>
            @endforeach
        </table>
    </div>
    @endif

    @if(route('exam.report', ['exam' => $exam->id]) == url()->current())
    <div class="flex">
        <x-card description="Average Score">
            {{number_format($exam->averageScore(), 2)}}
        </x-card>
        <x-card description="Lowest Score">
            {{$exam->lowestScore()}}
        </x-card>
        <x-card description="Highest Score">
            {{$exam->highestScore()}}
        </x-card>
    </div>
    @endif

</x-new-layout>
