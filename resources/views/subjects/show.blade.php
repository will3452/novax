<x-app>
    <x-page-container>
       <div class="card">
           <div class="card-header bg-primary text-white">
               Subject Information
           </div>
           <div class="card-body">
               <div class="my-2">
                   Subject Description: {{$subject->name}}
               </div>
               <div class="my-2">
                   Subject Code: {{$subject->code}}
               </div>

               <div class="card">
                   <div class="card-header">
                       Progress ( {{number_format(auth()->user()->getMySubjectProgress($subject->id), 2)}}% )
                   </div>
                   <div class="card-body">
                    <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{auth()->user()->getMySubjectProgress($subject->id)}}%" aria-valuenow="50" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="mt-5">
        <x-page-header>
            Modules
        </x-page-header>
       </div>
        <div class="mt-2">
            @forelse  ($subject->modules as $module)
            <div class="col-md-12 mb-4">
                <div class="card border-left-primary shadow h-20 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$module->description}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$module->code}}</div>
                            </div>
                            <div class="col text-right">
                                @if (!auth()->user()->isModuleDone($module->id))
                                    <form action="/mark-as-done" method="POST">
                                        @csrf
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <input type="hidden" name="module_id" value="{{$module->id}}">
                                        <button class="btn btn-primary btn-sm">Mark As Done</button>
                                    </form>
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
                                                    @if (!$item->wasTaken(auth()->id()))
                                                        <a class="btn btn-sm btn-primary p-0 px-1 rounded" href="/quizzes/{{$item->id}}">Take now</a>
                                                    @else
                                                        <div class="text-xs">Your Score : {{$item->getScore(auth()->id())}}/{{$item->questions()->count()}}</div>
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
                                                    @if (!$item->wasTaken(auth()->id()))
                                                        <a class="btn btn-sm btn-primary p-0 px-1 rounded" href="/quizzes/{{$item->id}}">Take now</a>
                                                    @else
                                                        <div class="text-xs">Your Score : {{$item->getScore(auth()->id())}}/{{$item->questions()->count()}}</div>
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
            @empty
            <div class="card card-body text-center bg-light">
                No Module Uploaded yet!
            </div>
            @endforelse
       </div>
    </x-page-container>
</x-app>
