@props(['title'])
<div class="row mt-4">
    <div class="col-md-3" >
        <div class="card">
            <div class="card-header">
                Status
            </div>
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M10 20.777a9 9 0 0 1-2.48-.969M14 3.223a9.003 9.003 0 0 1 0 17.554m-9.421-3.684a9 9 0 0 1-1.227-2.592M3.124 10.5c.16-.95.468-1.85.9-2.675l.169-.305m2.714-2.941A9 9 0 0 1 10 3.223"/><path d="m9 12l2 2l4-4"/></g></svg>
                {{$title->group->status}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Defense Schedule
            </div>
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5m-4-9v4M8 3v4m-4 4h16m-1 5l-2 3h4l-2 3"/></svg>
                {{$title->group->defense_schedule ? $title->group->defense_schedule->format('m/d/Y') : '---'}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Verdict
            </div>
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4M7 4h10m0 0v8a5 5 0 0 1-10 0V4M3 9a2 2 0 1 0 4 0a2 2 0 1 0-4 0m14 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0"/></svg>
                {{$title->group->verdict ?? '---'}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
       <div class="card">
        <div class="card-header">
            Members
        </div>
        <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1M15 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2 5h2a2 2 0 0 1 2 2v1M5 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h2"/></svg>
            {{$title->group->groupMembers()->count()}}
        </div>
       </div>
    </div>
</div>
<div class="my-4"></div>
<div class="card">
    <div class="card-header">
        Group Members
    </div>
    <div class="card-body">
        <table id="dt" class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>
                        Student
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($title->group->groupMembers as $item)
                    <tr>
                        <td>
                            {{$item->student->name}}
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
