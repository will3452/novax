<x-auth>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-img-top" style="background: url('/section.jpg');height:150px; display:flex; align-items:center; justify-content:center;">
                        <h1 class="text-center py-4 text-white">{{$title->title}}</h1>
                    </div>
                    <div class="card-body">
                       <div class="d-flex justify-content-between align-items-center">
                        <h4>{{$title->status == 'APPROVED' ? $title->group->code : '-'}} </h4>
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
                @if ($title->group->defense_schedule == null && $title->group->status == 'Ongoing')
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
                                    Endorse for Oral Defense
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                @if ($title->group->oralDefenseRequests()->whereStatus('Panelist Approval')->count())
                    <x-title-actions :title="$title"></x-title-actions>
                @endif
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
                <x-title-navs :title="$title"></x-title-navs>
               <div class="p-2 bg-white bordered">
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
                @if (request()->tab == 'revision')
                    <x-title-revisions :title="$title"></x-title-revisions>
                @endif
                <x-bulletin :title="$title"></x-bulletin>
               </div>
            </div>
        </div>
    </div>
    <script>
        window.$('.student-select').select2()
    </script>
</x-auth>
