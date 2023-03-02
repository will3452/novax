<x-.main>
    <h1 class="page-header">
        Patient's Information
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('generals.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Profile</th>
                    <th>Temp</th>
                    <th>BP</th>
                    <th>HR</th>
                    <th>PR</th>
                    <th>O2 Level</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($generals as $g)
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
                        {{$g->temp}}
                    </td>
                    <td>
                        {{$g->bp}}
                    </td>
                    <td>
                        {{$g->hr}}
                    </td>
                    <td>
                        {{$g->pr}}
                    </td>
                    <td>
                        {{$g->o2_level}}
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                        <x-delete model="General" :id="$g->id">
                            <a href="{{route('generals.edit', ['general' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        </x-delete>
                        @endif
                        <a href="{{route('generals.show' , ['general' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
