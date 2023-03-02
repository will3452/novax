<x-.main>
    <h1 class="page-header">
        Profiles
    </h1>
    @if (auth()->user()->role == 'ADMIN')
    <div >
        <a href="{{route('profiles.create')}}" class="btn btn-primary">Create new profile</a>
    </div>
    @endif
    <br/>
    <div class="table-responsive ">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Purok</th>
                    <th>Civil Satus</th>
                    <th>Occupation</th>
                    <th>Birthdate</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $p)
                <tr>
                    <td>
                        {{$p->last_name}}, {{$p->first_name}} {{$p->middle_name}}
                    </td>
                    <td>
                        {{$p->purok}}
                    </td>
                    <td>
                        {{$p->civil_status}}
                    </td>
                    <td>
                        {{$p->occupation}}
                    </td>
                    <td>
                        {{$p->birthdate}}
                    </td>
                    <td>
                        @if (auth()->user()->role == 'ADMIN')
                            <x-delete model="Profile" :id="$p->id">
                                <a href="{{route('profiles.edit', ['profile' => $p->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-edit"></i> Update</a>
                            </x-delete>
                        @endif
                        <a href="{{route('profiles.show' , ['profile' => $p->id])}}" class="btn btn-default btn btn-sm"> <i class="fa fa-eye"></i> View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
