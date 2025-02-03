@props(['title'])
<div class="my-4"></div>
<div class="row">
    <div class="col-md-12">
        <table id="dt" class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Venue</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($title->group->oralDefenseRequests()->latest()->get() as $item)
                    <tr>
                        <td>
                            @if ($item->status == 'Submit Oral Defense Request')
                                Not Submitted
                            @else
                                {{$item->status}}
                            @endif
                        </td>
                        <td>
                            {{$item->date->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$item->time}}
                        </td>
                        <td>
                            {{$item->venue}}
                        </td>
                        <td class="text-center d-flex gap-2">
                            <a class="btn btn-success btn-sm " href="{{route('form', ['form' => 'oral_defense', 'model' => $item])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2m-8-4h6m-6-4h6"/></g></svg>
                                Show Form
                            </a>
                            @student
                                @if ($item->status == 'Submit Oral Defense Request')
                                    <form action="{{route('titles.submit.oral', ['title' => $title, 'oral' => $item])}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="m17.831 3.306l-9.726 13.9c-.26.37-.045.794.395.794h4c.35 0 .5.14.5.5v10.763c0 .71.86 1.02 1.27.45l9.618-12.828c.27-.37.052-.885-.388-.885H20c-.5 0-1-.5-1-1V3.5c0-.5-.76-.774-1.169-.194"/></svg>
                                            Request Approval
                                        </button>
                                    </form>
                                @endif
                            @endstudent
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
