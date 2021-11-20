<x-app>
    <x-page-container>
        <div class="card">
            <div class="card-header">
                Room : {{$student->latestRoom()->name}}
            </div>
            <div class="card-body">
                <form action="/load-report" method="POST">
                    <input type="hidden" name="student_id" value="{{$student->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="">Select Subject</label>
                        <div>
                            <select name="subject_id" required id="">
                                <option value="" selected disabled></option>
                                @foreach ($student->latestRoom()->subjects as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->description}}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">
                                LOAD REPORT
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="my-2"></div>
        @if ($subject === null)
            <div class="alert alert-warning">
                No Record Found.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    {{$subject->description}} - Progress Ratio ( {{number_format($student->getMySubjectProgress($subject->id), 2)}}% )
                </div>
                <div class="card-body">
                    <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{$student->getMySubjectProgress($subject->id)}}%" aria-valuenow="50" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            Student Total Earned Points : {{$student->getTotalScoreToSubject($subject->id)}} pts
                        </div>
                        <div class="col-md-6">
                            Subject Total Points : {{$subject->getTotalScore()}} pts
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    Quizzes and Exams
                </div>
                <div class="card-body">
                    @foreach ($subject->modules as $module)
                    <div class="col-md-12 mb-4">
                        <div class="card border-left-primary shadow h-20 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$module->description}}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$module->code}}</div>
                                    </div>
                                    <div class="col text-right">
                                        @if (!$student->isModuleDone($module->id))
                                            Not Yet
                                        @else
                                            Done
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                   <div class="col-md-5 card card-body mr-2">
                                        <strong>
                                            Materials
                                       </strong>
                                       <ul>
                                           @foreach ($module->materials as $item)
                                           <li>
                                               @if ($item->link == null)
                                                   <a href="/storage/{{$item->file}}">{{$item->title}}</a>
                                                @else
                                                    <a target="_blank" href="{{$item->link}}">
                                                        {{$item->title}}
                                                    </a>
                                               @endif
                                           </li>
                                           @endforeach
                                       </ul>
                                   </div>
                                   @if ($module->quizzes()->count() != 0 || $module->exams()->count() != 0)
                                   <div class="col-md-5 card card-body mr-2">
                                        <strong>
                                            Quizzes & Exams
                                        </strong>
                                        <div class="row">
                                            <div class="col">
                                                    <ul>
                                                        @foreach ($module->quizzes as $item)
                                                        <li>
                                                            {{$item->description}}
                                                            @if (!$item->wasTaken($student->id))
                                                                <div class="text-sm text-danger">
                                                                    Not yet
                                                                </div>
                                                            @else
                                                                <div class="text-xs">Your Score : {{$item->getScore($student->id)}}/{{$item->questions()->count()}}</div>
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                            </div>
                                            <div class="col">
                                                    <ul>
                                                        @foreach ($module->exams as $item)
                                                        <li>
                                                            {{$item->description}}
                                                            @if (!$item->wasTaken($student->id))
                                                                <div class="text-sm text-danger">
                                                                    Not yet
                                                                </div>
                                                            @else
                                                                <div class="text-xs">Your Score : {{$item->getScore($student->id)}}/{{$item->questions()->count()}}</div>
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                            </div>
                                        </div>
                                   </div>
                                   @endif
                               </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        @endif
    </x-page-container>
</x-app>
