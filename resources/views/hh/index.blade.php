<x-.main>
    <h1 class="page-header">
        Family House Hold Profile
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('hh.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hh as $g)
                <tr>
                    <td>
                        {{$g->created_at->format('M d, Y')}}
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                            <x-delete model="FamilyHouseholdProfile" :id="$g->id">
                                <a href="{{route('hh.edit', ['hh' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                            </x-delete>
                        @endif
                        <a href="{{route('hh.show' , ['hh' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
