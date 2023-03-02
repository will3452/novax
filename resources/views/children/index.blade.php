<x-.main>
    <h1 class="page-header">
        Children
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('children.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Mother</th>
                    <th>Child</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $g)
                <tr>
                    <td>
                        {{$g->created_at->format('M d, Y')}}
                    </td>
                    <td>
                        <a href="{{route('profiles.show', ['profile' => $g->mother_profile_id])}}">
                            {{$g->mother->last_name}}, {{$g->mother->first_name}} {{$g->mother->middle_name}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('profiles.show', ['profile' => $g->child_profile_id])}}">
                            {{$g->child->last_name}}, {{$g->child->first_name}} {{$g->child->middle_name}}
                        </a>
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                        <x-delete model="Children" :id="$g->id">
                            <a href="{{route('children.edit', ['children' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        </x-delete>
                        @endif
                        <a href="{{route('children.show' , ['children' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
