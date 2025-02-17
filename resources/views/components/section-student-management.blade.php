@props(['section'])
<div class="row p-2 bg-white bordered">
    <div class="@nonstudent col-md-8 @else col-md-12 @endnonstudent">
        <table id="dt" class="table table-bordered table-striped my-4">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Student
                    </th>
                    <th>
                        Program
                    </th>
                    @nonstudent
                    <th>
                        Action
                    </th>
                    @endnonstudent
                </tr>
            </thead>
            <tbody>
                @foreach ($section->students as $key=>$item)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$item->student->name}}
                        </td>
                        <td>
                            {{$item?->student->course ?? "N/a"}}
                        </td>
                            @nonstudent
                                <td class="text-center">
                                    <form id="x{{$item->student_id}}"  action="{{route('sections.remove-student')}}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="section_id" value="{{$section->id}}">
                                        <input type="hidden" name="student_id" value="{{$item->student_id}}">
                                        <button type="button" onclick="confirmSubmission(`x{{$item->student_id}}`)" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/></svg> Remove
                                        </button>
                                    </form>
                                </td>
                            @endnonstudent
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @nonstudent
    <div class="col-md-4">
        <x-section-add-student-form :section="$section"></x-section-add-student-form>
    </div>
    @endnonstudent
  </div>

  <script>
    function confirmSubmission(id) {
        let isYes = confirm('Are you sure you want to remove student from this section? ')
        if (isYes) {
            $(`#${id}`).submit()
        }
    }
  </script>
