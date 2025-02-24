@php
    $records = [];
    if (request()->filter == 'all' || ! request()->filter) {
        $records = \App\Models\Task::where('status', '!=', 'PENDING')->whereUserId(auth()->id())->latest()->get();
    } else {
        $records = \App\Models\Task::where('status', '!=', 'PENDING')->whereTaskType(request()->filter)->whereUserId(auth()->id())->latest()->get();
    }
@endphp
@forelse  ($records as $item)
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 22.5a4.75 4.75 0 0 1 3.5-3.5a4.75 4.75 0 0 1-3.5-3.5a4.75 4.75 0 0 1-3.5 3.5a4.75 4.75 0 0 1 3.5 3.5M12 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v7M3 10h18M10 3v18"/></svg>
                                <div class="badge {{$item->status == 'APPROVED' ? 'bg-success' : 'bg-danger'}}"> {{$item->status}} </div>
                            </div>
                            <div>
                                {{$item->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div>{{$item->description}}</div>
                            @if ($item->status != 'APPROVED')
                                <div>
                                    Reason: <div style="font-style: italic">{{$item->reason}}</div>
                                </div>
                            @endif
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
