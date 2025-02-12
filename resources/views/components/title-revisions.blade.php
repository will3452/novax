@props(['title'])
<div class="my-4"></div>
<div class="row">
    <div class="@nonstudent col-md-8 @else col-md-12 @endnonstudent">
        <table id="dt" class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Revision</th>
                    <th>Faculty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($title->group->revisions as $key => $item)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$item->revision}}
                        </td>
                        <td>
                            {{$item->faculty->name}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @nonstudent
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">New Revision</div>
            <div class="card-body">
                <form class="d-flex flex-column gap-3" action="{{route('revisions.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="group_id" value="{{$title->group->id}}"/>
                    <input type="hidden" name="faculty_id" value="{{auth()->id()}}"/>
                    <div class="form-group">
                        <label for="" class="form-label">Remarks</label>
                        <textarea required name="revision" id="" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endnonstudent
</div>
