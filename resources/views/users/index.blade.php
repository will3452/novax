<x-.main>
    <h1 class="page-header">
        Users
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('users.create')}}" class="btn btn-primary">Register new user</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Role</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $g)
                <td>
                    {{$g->created_at->format('M d, Y')}}
                </td>
                <td>
                    {{$g->email}}
                </td>
                <td>
                    {{$g->role}}

                </td>
                    @if (auth()->user()->role == 'ADMIN')
                        <td>
                            <a href="{{route('users.edit', ['user' => $g->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                        </td>
                    @else
                        <td>

                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
