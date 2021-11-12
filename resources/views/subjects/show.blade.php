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

           </div>
       </div>
       <div class="mt-5">
        <x-page-header>
            Modules
        </x-page-header>
       </div>
        <div class="row mt-2">
            @forelse  ($subject->modules as $module)
            <div class="col-md-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{$module->description}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$module->code}}</div>
                            </div>
                            <div class="col text-right">
                                Status: Done
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
                                            <a href="{{$item->link}}">
                                                {{$item->title}}
                                            </a>
                                       @endif
                                   </li>
                                   @endforeach
                               </ul>
                           </div>
                           <div class="col-md-5 card card-body mr-2">
                            <strong>
                                Quizzes & Exams
                           </strong>
                           <ul>
                               @foreach ($module->quizzes as $item)
                               <li>
                                {{$item->description}} <a class="btn btn-sm btn-primary p-0 px-1 rounded" href="/quizzes/{{$item->id}}">Take now</a>
                                </li>
                               @endforeach
                           </ul>
                       </div>
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
