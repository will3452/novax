<div class="card">
    <div class="card-header bg-primary text-white">
        Create New Section
    </div>
    <div class="card-body">
        <form action="/sections" method="POST" class="d-flex flex-column gap-3">
            @csrf
            <div class="form-group">
                <label for="section">
                    Section name
                </label>
                <input type="text" name="section" required class="form-control">
            </div>
            <div class="form-group">
                <label for="">School Year</label>
                <select name="school_year" id="" class="form-select">
                    @foreach (\App\Models\SchoolYear::get() as $item)
                        <option value="{{$item->name}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Term</label>
                <select name="term" id="" class="form-select">
                    @foreach (\App\Models\Term::get() as $item)
                        <option value="{{$item->name}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">IC Type</label>
                <select name="ic_type" id="" class="form-select">
                    <option value="{{\App\Models\Title::IC_TYPE_CAPSTONE}}">{{\App\Models\Title::IC_TYPE_CAPSTONE}}</option>
                    <option value="{{\App\Models\Title::IC_TYPE_THESIS}}">{{App\Models\Title::IC_TYPE_THESIS}}</option>
                    <option value="{{\App\Models\Title::IC_TYPE_PLANT_DESIGN}}">{{\App\Models\Title::IC_TYPE_PLANT_DESIGN}}</option>
                    <option value="{{\App\Models\Title::IC_TYPE_FEASIBILITY_STUDY}}">{{\App\Models\Title::IC_TYPE_FEASIBILITY_STUDY}}</option>
                    <option value="{{\App\Models\Title::IC_TYPE_BUSINESS_PLAN}}">{{\App\Models\Title::IC_TYPE_BUSINESS_PLAN}}</option>
                </select>
            </div>
            <input type="hidden" name="thesis_phase" value="{{\App\Models\Section::PHASE_PROPOSAL}}" />
            <input type="hidden" name="no_of_students" value="{{nova_get_setting('no_of_students', 3)}}" />
            <input type="hidden" name="creator_id" value="{{auth()->id()}}" />
            <div class="form-group">
                <label for="course_id">
                    Course
                </label>
                <select name="course_id" id="" class="form-select">
                    @foreach (\App\Models\Course::get() as $item)
                        <option value="{{$item->id}}">
                            {{$item->name}} ({{$item->thesis_phase}})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>
</div>
