<x-.main>
    <h1 class="page-header">
        PWD
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('pwd.create')}}" class="btn btn-primary">Add New Record</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>pwd</th>
                    <th>PWD ID</th>
                    <th>Type of disabilty</th>
                    <th>Remarks</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pwds as $g)
                <tr>
                    <td>
                        {{$g->created_at->format('M d, Y')}}
                    </td>
                    <td>
                        <a href="{{route('pwd.show', ['pwd' => $g->pwd_id])}}">
                            {{$g->profile->last_name}}, {{$g->profile->first_name}} {{$g->profile->middle_name}}
                        </a>
                    </td>
                    <td>
                        {{$g->pwd_id}}
                    </td>
                    <td>
                        {{$g->type_of_disability}}
                    </td>
                    <td>
                        {{$g->remarks}}
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                        <x-delete model="pwd" :id="$g->id">
                            <a href="{{route('pwd.edit', ['pwd' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        </x-delete>
                        @endif
                        <a href="{{route('pwd.show' , ['pwd' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
