<x-auth>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>Sections</div>
                            <div>
                                @if (request()->filter == 'my')
                                    <a href="?filter=all" class="btn btn-secondary">All Sections</a>
                                @else
                                    <a href="?filter=my"  class="btn btn-secondary">My Sections</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="dt" class="table table-striped table-bordered my-4" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>IC type</th>
                                    <th>School Year</th>
                                    <th>Term</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $item)
                                    <tr>
                                        <td>
                                            {{$item->section}}
                                        </td>
                                        <td>
                                            {{$item->course->name}}
                                        </td>
                                        <td>
                                            {{$item->ic_type}}
                                        </td>
                                        <td>
                                            {{$item->school_year}}
                                        </td>
                                        <td>
                                            {{$item->term}}
                                        </td>
                                        <td class="text-center">
                                            <a href="/sections/{{$item->id}}?tab=titles" class="btn btn-sm btn-success">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @nonstudent
                @coordinator
                <div class="col-md-3">
                    <x-section-create></x-section-create>
                </div>
                @endcoordinator
            @endnonstudent
        </div>
    </div>
</x-auth>
