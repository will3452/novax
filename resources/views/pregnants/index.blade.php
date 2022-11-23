<x-layouts.main>
    <h1 class="page-header">
        Pregnant
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('pregnants.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Profile</th>
                    <th>Husband</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pregnants as $g)
                <tr>
                    <td>
                        {{$g->created_at->format('M d, Y')}}
                    </td>
                    <td>
                        <a href="{{route('profiles.show', ['profile' => $g->profile_id])}}">
                            {{$g->profile->last_name}}, {{$g->profile->first_name}} {{$g->profile->middle_name}}
                        </a>
                    </td>
                    <td>
                        {{$g->husband}}
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                        <a href="{{route('pregnants.edit', ['pregnant' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        @endif
                        <a href="{{route('pregnants.show' , ['pregnant' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.main>
