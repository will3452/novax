<x-app>
    <x-page-container>
        <div class="row">
            <div class="col-md-8">
               @parent()
               <div class="card">
                   <div class="card-header">
                        Add Students
                   </div>
                   <div class="card-body">
                       <form action="/add-student" method="POST">
                        @csrf
                           <input type="text" required placeholder="Student Email" name="email">

                           <button class="btn btn-sm btn-success">Add my Student</button>
                           <div>
                            @if (session('success'))
                            <div class="text-left text-success text-sm">
                                {{session('success')}}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="text-left text-danger text-sm">
                                {{session('error')}}
                            </div>
                        @endif
                           </div>
                       </form>
                   </div>
               </div>
               <div class="my-2">
                    <div class="card">
                        <div class="card-header">
                            Your Student
                        </div>
                        <div class="card-body">
                            @forelse (auth()->user()->userStudents as $us)
                                <div class="card mt-2 ">
                                   <div class="card-body d-flex justify-content-between">
                                    {{$us->student->name}}
                                    <form action="/remove-student">
                                        <a class="btn btn-sm btn-success" href="/view-progress/{{$us->student_id}}">View Progress</a>
                                        <input type="hidden" name="student_id" value="{{$us->student_id}}">
                                        <button class="btn btn-sm btn-secondary">remove</button>
                                    </form>
                                   </div>
                                </div>
                            @empty
                                <div class="alert alert-warning">
                                    No Student Found.
                                </div>
                            @endforelse
                        </div>
                    </div>
               </div>
               @else
               <div class="card">
                    <div class="card-header">
                        Room : <strong>{{auth()->user()->latestRoom() ? auth()->user()->latestRoom()->name : ''}}</strong>
                    </div>
                    @if (auth()->user()->latestRoom())
                    <div class="card-body">
                        <ul class="p-0">
                            @foreach (auth()->user()->latestRoom()->subjects as $subject)
                                <li class="my-2 card card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            {{$subject->description}}
                                        </div>
                                        <div>
                                            <a class="btn btn-sm btn-primary p-0 px-1" style="border-radius:20px;" href="/subjects/{{$subject->id}}">view</a>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{auth()->user()->getMySubjectProgress($subject->id)}}%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
               @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Account Information
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div style="width:200px; height: 200px; border-radius:50%;font-size:90px;text-transform:uppercase;" class="text-white bg-primary d-flex justify-content-center align-items-center">
                                {{auth()->user()->name[0]}}
                            </div>
                        </div>
                        <div class="my-4">
                            <form class="user" method="POST" action="/update">
                                @csrf
                                <div class="form-group">
                                    <input readonly value="{{auth()->user()->name}}" required type="text" name="" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Name">
                                    @error('name')
                                    <div class="text-center">
                                        <span class="text-xs text-danger">
                                            {{$message}}
                                        </span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input value="{{auth()->user()->email}}" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" readonly required>
                                    @error('email')
                                    <div class="text-center">
                                        <span class="text-xs text-danger">
                                            {{$message}}
                                        </span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                            <div class="text-center">
                                                <span class="text-xs text-danger">
                                                    {{$message}}
                                                </span>
                                            </div>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            @foreach (auth()->user()->classRooms as $room)
            <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{$room->name}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$room->code}}</div>
                            </div>
                            <div class="col-auto">
                                <a href="/rooms/{{$room->id}}" class="btn-white btn-sm btn" ><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
       </div> --}}
    </x-page-container>
</x-app>
