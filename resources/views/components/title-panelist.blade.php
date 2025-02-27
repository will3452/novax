@props(['title'])
<div class="row mt-4">
    <div class="
        @student col-md-8 @else col-md-12 @endstudent
    ">
        <table id="dt" class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>
                        Faculty
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($title->group->panellists as $item)
                        <tr>
                            <td>
                                {{auth()->user()->name == $item->faculty->name ? 'You' : $item->faculty->name}}
                            </td>
                            <td>{{$item->type}} </td>
                            <td>{{$item->status}}</td>
                            <td class="text-center">
                                @if ($item->type == "Adviser" || $item->status == 'APPROVED')
                                    {{-- <button onclick="javascript:alert('unauthorized action');" disabled class="btn btn-secondary" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z"/></svg>
                                        Remove
                                    </button> --}}
                                @else
                                    <form action="{{route('titles.remove.panelist', $title->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="faculty_id" value="{{$item->faculty->id}}" />
                                        <button  class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z"/></svg>
                                            Remove
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    @student
    <div class="col-md-4 d-flex flex-column gap-3">
        @if ($title->group->status == 'For Panel Approval' && $title->group->panellists()->whereStatus('APPROVED')->whereType('Chair')->exists() && $title->group->panellists()->whereStatus('APPROVED')->whereType('Member')->exists())
            <form action="{{route('titles.lock.panelist', $title->id)}}" method="POST" class="d-flex justify-content-end">
                @csrf
                <button class="btn btn-success d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 13a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z"/><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V7a4 4 0 1 1 8 0v4"/></g></svg>
                    Lock Panelist
                </button>
            </form>
        @else
        <div class="d-flex justify-content-end">
            <button disabled class="btn btn-success d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 13a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z"/><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V7a4 4 0 1 1 8 0v4"/></g></svg>
                Lock Panelist
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                Add Panelist
            </div>
            <div class="card-body">
                <form action="{{route('titles.add.panelist', $title)}}" method="POST" class="d-flex flex-column gap-3">
                    @csrf
                    <div class="form-group">
                        <label for="">Select Faculty</label>
                        @php
                            $exceptFaculty = $title->group->panellists->pluck('faculty_id')->all();
                        @endphp
                        <select  name="faculty_id[]" class="student-select form-select" id="" multiple="multiple">
                            @foreach (\App\Models\User::whereType('Faculty')->whereNotIn('id', $exceptFaculty)->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <select class="form-control" name="type" id="">
                            @foreach ([\App\Models\Panellist::TYPE_CHAIR, \App\Models\Panellist::TYPE_MEMBER] as $item)
                                <option value="{{$item}}">
                                    {{$item}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Send Invitation</button>
                </form>
            </div>
        </div>
    </div>
    @endstudent
</div>
