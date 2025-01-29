@props(['section'])
<div class="card">
    <div class="card-header">
        Add Student
    </div>
    <div class="card-body">
        <form action="{{route('sections.add-student')}}" method="POST" class="d-flex flex-column gap-3">
            @csrf
            <input type="hidden" name="section_id" value="{{$section->id}}" />
            <div class="form-group">
                <label for="">Select Student</label>
                @php
                    $exceptStudents = $section->students->pluck('student_id')->all();
                @endphp
                <select  name="student_id[]" class="student-select form-select" id="" multiple="multiple">
                    @foreach (\App\Models\User::whereType('Student')->whereNotIn('id', $exceptStudents)->get() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    window.$('.student-select').select2()
</script>
