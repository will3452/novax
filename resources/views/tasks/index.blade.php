<x-auth>
    <div class="container">
        <h1>My Tasks</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V3m4.25 4.75L18.4 5.6M18 12h3m-4.75 4.25l2.15 2.15M12 18v3m-4.25-4.75L5.6 18.4M6 12H3m4.75-4.25L5.6 5.6"/></svg> Pending
                </h3>
                <div style="height: 70vh; overflow-y: auto;">

                    @forelse (\App\Models\Task::whereStatus('PENDING')->whereUserId(auth()->id())->get() as $item)
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 22.5a4.75 4.75 0 0 1 3.5-3.5a4.75 4.75 0 0 1-3.5-3.5a4.75 4.75 0 0 1-3.5 3.5a4.75 4.75 0 0 1 3.5 3.5M12 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v7M3 10h18M10 3v18"/></svg>
                            </div>
                            <div>
                                {{$item->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div>{{$item->description}}</div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2">
                                @if ($item->task_type == "App\Models\Title")
                                    <a href="{{route('titles.show', $item->task_id)}}" class="btn btn-primary">View Title</a>
                                @endif
                                <form method="POST" action="{{route('tasks.approve', $item->id)}}">
                                    @csrf
                                    <button class="btn btn-success">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{route('tasks.reject', $item->id)}}">
                                    @csrf
                                    <button class="btn btn-danger">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="alert alert-warning text-center">
                    No Task
                </div>
                @endforelse
                </div>
            </div>
            <div class="col-md-6 ">
                <h3><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4c.852 0 1.297.986.783 1.623l-.076.084L15.915 9.5l3.792 3.793c.603.602.22 1.614-.593 1.701L19 15H6v6a1 1 0 0 1-.883.993L5 22a1 1 0 0 1-.993-.883L4 21V5a1 1 0 0 1 .883-.993L5 4z"/></svg>Done</h3>
                <div style="height: 70vh; overflow-y: auto;">

                    @forelse  (\App\Models\Task::where('status', '!=', 'PENDING')->whereUserId(auth()->id())->get() as $item)
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 22.5a4.75 4.75 0 0 1 3.5-3.5a4.75 4.75 0 0 1-3.5-3.5a4.75 4.75 0 0 1-3.5 3.5a4.75 4.75 0 0 1 3.5 3.5M12 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v7M3 10h18M10 3v18"/></svg>
                            </div>
                            <div>
                                {{$item->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div>{{$item->description}}</div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2">
                                @if ($item->task_type == "App\Models\Title")
                                    <a href="{{route('titles.show', $item->task_id)}}" class="btn btn-primary">View Title</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-warning text-center">
                            No Task
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-auth>
