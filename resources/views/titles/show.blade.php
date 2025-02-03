<x-auth>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="/section.jpg" alt="" class="card-img-top">
                    <div class="card-body">
                       <div class="d-flex justify-content-between align-items-center">
                        <h4>{{$title->title}} </h4>
                        <span class="badge bg-primary">{{$title->status}}</span>
                       </div>
                        <div>
                            {{$title->description}}
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                Faculty
                            </div>
                            <div class="col-6">
                                {{$title->faculty->name}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                Area of research
                            </div>
                            <div class="col-6">
                                {{$title->area_of_research}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                IC type
                            </div>
                            <div class="col-6">
                                {{$title->ic_type}}
                            </div>
                        </div>
                    </div>
                </div>
                @nonstudent
                @if ($title->group->defense_schedule == null)
                    <div class="card mt-2">
                        <div class="card-header">
                            Endorse Group
                        </div>
                        <div class="card-body">
                            <form class="d-flex flex-column gap-3" action="{{route('titles.endorse.group', $title)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="form-label">
                                        Preferred Schedule
                                    </label>
                                    <input type="date" name="date"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">
                                        Time
                                    </label>
                                    <input type="text" name="time" class="form-control" placeholder="eg. 10:00 am"/>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">
                                        Venue
                                    </label>
                                    <input type="text" name="venue" class="form-control" placeholder="eg. Computer Room"/>
                                </div>
                                <button class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 16"><path fill="currentColor" d="M12.49 7.14L3.44 2.27c-.76-.41-1.64.3-1.4 1.13l1.24 4.34q.075.27 0 .54l-1.24 4.34c-.24.83.64 1.54 1.4 1.13l9.05-4.87a.98.98 0 0 0 0-1.72Z"/></svg>
                                    Endorse Group
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                <div class="card mt-2">
                    <div class="card-header">
                        Actions
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-3 flex-column ">
                            <a href="{{route('form', ['form' => 'acceptance', 'model' => $title->group])}}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><g fill="currentColor"><path d="M32.707 22.707a1 1 0 0 0-1.414-1.414L24 28.586l-3.293-3.293a1 1 0 0 0-1.414 1.414L24 31.414z"/><path fill-rule="evenodd" d="M38 15v21a3 3 0 0 1-3 3H17a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3h11zm-10 1a1 1 0 0 1-1-1V7H17a1 1 0 0 0-1 1v28a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V16zm1-7.172L34.172 14H29z" clip-rule="evenodd"/><path d="M12 11v27a3 3 0 0 0 3 3h19v2H15a5 5 0 0 1-5-5V11z"/></g></svg>
                                Acceptance Form
                            </a>
                            <a href="{{route('form', ['form' => 'revision', 'model' => $title->group])}}" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 16.2l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z"/></svg>
                                Requirements for Revision Form
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endnonstudent
            </div>
            <div class="col-md-9">
                @student
                    @if ($title->group->oralDefenseRequests()->whereStatus('Submit Oral Defense Request')->exists())
                        <div class="alert alert-info">
                            You need to submit or have the oral defense request approved.
                        </div>
                    @endif
                @endstudent
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{request()->tab == null || request()->tab == 'group' ? 'active' : ''}}" href="?tab=group">Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->tab == 'panelist' ? 'active' : ''}}" href="?tab=panelist">Panelist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->tab == 'progress' ? 'active' : ''}}" href="?tab=progress">Progress report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->tab == 'oral' ? 'active' : ''}}" href="?tab=oral">Oral Defense Request</a>
                    </li>
                </ul>
                @if (request()->tab == 'panelist')
                  <x-title-panelist :title="$title"></x-title-panelist>
                @endif
                @if (request()->tab == 'group')
                    <x-title-group :title="$title"></x-title-group>
                @endif
                @if (request()->tab == 'progress')
                    <x-title-progress :title="$title"></x-title-progress>
                @endif
                @if (request()->tab == 'oral')
                    <x-title-oral :title="$title"></x-title-oral>
                @endif
            </div>
        </div>
    </div>
    <script>
        window.$('.student-select').select2()
    </script>
</x-auth>
