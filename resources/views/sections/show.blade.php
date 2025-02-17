<x-auth>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img alt="Card image cap" src="/section.jpg" alt="" class="card-img-top">
                    <div class="card-body">
                        <h4>
                            {{$section->section}}
                        </h4>
                        <div>
                            {{$section->term}}, {{$section->school_year}}
                        </div>
                        <div >
                            <span class="badge bg-primary" title="Course">
                                {{$section->course->name}}
                            </span>
                            <span class="badge bg-success" title="IC TYPE">
                                {{$section->ic_type}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                         <a class="nav-link {{request()->tab == 'titles' ? 'active' : ''}}" href="?tab=titles">Titles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->tab == null || request()->tab == 'students' ? 'active' : ''}}" href="?tab=students">Students</a>
                    </li>
                </ul>

          @if (request()->tab == 'students' || request()->tab == null)
            <x-section-student-management :section="$section"></x-section-student-management>
            @else
                <div class="row pt-2 bordered bg-white">
                    <div class="@nonstudent col-md-8 @else col-md-12 @endnonstudent">
                        <table id="dt" class="table table-bordered table-striped my-4">
                            <thead>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Faculty
                                    </th>
                                    <th>
                                        Area of Research
                                    </th>
                                    <th>
                                        IC Type
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
                                @foreach ($section->titles as $item)
                                    <tr>
                                        <td>
                                            {{$item->title}}
                                        </td>
                                        <td>
                                            {{$item->description}}
                                        </td>
                                        <td>
                                            {{$item->faculty->name}}
                                        </td>
                                        <td>
                                            {{$item->area_of_research}}
                                        </td>
                                        <td>
                                            {{$item->ic_type}}
                                        </td>
                                        <td>
                                            {{$item->status}}
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center gap-2">
                                            @if (\App\Models\TitleApplication::whereStudentId(auth()->id())->whereTitleId($item->id)->whereStatus('APPROVED')->exists() || ! auth()->user()->isStudent())
                                                <a href="{{route('titles.show', $item->id)}}?tab=group" class="d-flex  gap-1 btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6m-7 1l9-9m-5 0h5v5"/></svg>
                                                    View
                                                </a>
                                            @endif
                                            @student
                                            <form action="{{route('titles.apply', $item->id)}}" method="POST">
                                                @csrf
                                                <button
                                                {{\App\Models\TitleApplication::whereStudentId(auth()->id())->whereTitleId($item->id)->exists() ? 'disabled' : ''}} class="btn btn-success btn-sm d-flex  gap-1" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.512 17.023L10 14l-7-3.5a.55.55 0 0 1 0-1L21 3l-4.45 12.324M15 19l2 2l4-4"/></svg>Apply</button>
                                            </form>
                                            @endstudent
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @nonstudent
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Submit Title
                            </div>
                            <div class="card-body">
                                <form action="{{route('sections.submit-title')}}" method="POST" class="d-flex gap-3 flex-column" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" required class="form-control" name="title" />
                                    </div>
                                    <input type="hidden" name="no_of_students" value="{{$section->no_of_students}}" />
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Area of research</label>
                                        <select name="area_of_research" id="" class="form-control">
                                            @foreach ([
                                                "SDG 1 - NO POVERTY",
                                                "SDG 2 - ZERO HUNGER",
                                                "SDG 3 - GOOD HEALTH AND WELL-BEING",
                                                "SDG 4 - QUALITY EDUCATION",
                                                "SDG 5 - GENDER EQUALITY",
                                                "SDG 6 - CLEAN WATER AND SANITATION",
                                                "SDG 7 - AFFORDABLE AND CLEAN ENERGY",
                                                "SDG 8 - DECENT WORK AND ECONOMIC GROWTH",
                                                "SDG 9 - INDUSTRY, INNOVATION AND INFRASTRUCTURE",
                                                "SDG 10 - REDUCED INEQUALITIES",
                                                "SDG 11 - SUSTAINABLE CITIES AND COMMUNITIES",
                                                "SDG 12 - RESPONSIBLE CONSUMPTION AND PRODUCTION",
                                                "SDG 13 - CLIMATE ACTION",
                                                "SDG 14 - LIFE BELOW WATER",
                                                "SDG 15 - LIFE ON LAND",
                                                "SDG 16 - PEACE, JUSTICE AND STRONG INSTITUTIONS",
                                                "SDG 17 - PARTNERSHIPS FOR THE GOALS"
                                            ] as $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if (auth()->user()->type !==  'Faculty')
                                    <div class="form-group">
                                        <label for="">Select Faculty</label>
                                        <select required name="faculty_id" id="" class="form-select faculty-select">
                                            @foreach (\App\Models\User::whereType('Faculty')->get() as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <input type="hidden" name="faculty_id" value="{{auth()->id()}}" >
                                    @endif
                                    <div class="form-group">
                                        <label for="">File</label>
                                        <input required type="file" name="file" class="form-control">
                                        <small id="emailHelp" class="form-text text-muted">Maximum of 5mb only.</small>
                                    </div>
                                    <input type="hidden" name="ic_type" value="{{$section->ic_type}}">
                                    <input type="hidden" name="section_id" value="{{$section->id}}">
                                    <input type="hidden" name="created_by_id" value="{{auth()->id()}}">
                                    <button class="btn btn-primary" type="submit">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endnonstudent
                </div>
            @endif
                    </div>
            </div>
    </div>
    <script>
        window.$('.faculty-select').select2()
    </script>
</x-auth>
