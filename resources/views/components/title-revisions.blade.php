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
                    <th>Actions</th>
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
                        <td>
                            <form action="{{route('revisions.remove', $item)}}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/></svg>
                                    Remove
                                </button>
                            </form>
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
