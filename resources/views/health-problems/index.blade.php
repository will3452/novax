<x-.main>
    <h1 class="page-header">
        Health Problems
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('healthProblems.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Profile</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($healthProblems as $g)
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
                        @if (auth()->user()->role == 'ADMIN')
                        <x-delete model="HealthProblem" :id="$g->id">
                            <a href="{{route('healthProblems.edit', ['healthProblem' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        </x-delete>
                        @endif
                        <a href="{{route('healthProblems.show' , ['healthProblem' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
