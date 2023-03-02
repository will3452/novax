<x-.main>
    <h1 class="page-header">
        Family House Hold Profile
    </h1>
    </h1>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Household profile Information</div>
                <div class="panel-body">
                    <x-description label="Purok" :value="$hh->purok"></x-description>
                    <x-description label="4'ps" value="{{$hh->four_ps ? 'Yes': 'No'}}"></x-description>
                    <x-description label="NHTS" value="{{$hh->nhts ? 'Yes': 'No'}}"></x-description>
                    <x-description label="Dialect" :value="$hh->dialect"></x-description>
                    <x-description label="Type of dwelling" :value="$hh->type_of_dwelling"></x-description>
                    <x-description label="Type of electricity" :value="$hh->type_of_electricity"></x-description>
                    <x-description label="Source of water" :value="$hh->source_of_water"></x-description>
                    <x-description label="Sanitation Facilities" :value="$hh->sanitation_facilities"></x-description>
                </div>
            </div>
        </div>
        @if (auth()->user()->role == 'ADMIN')
        <div class="col-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Attach Profile</div>
                <div class="panel-body">
                    <form method="POST" action="{{route('hh.toggle', ['hh' => $hh->id])}}">
                        @csrf
                        <x-select name="profile_id" label="Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                        <button class="btn btn-primary btn-block">ADD</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="table-responsive ">
        <h3>Profiles</h3>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Profile</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hh->profiles as $item)
                    <tr>
                        <td>
                            {{$item->created_at->format('M d, Y')}}
                        </td>
                        <td>
                            <a href="{{route('profiles.show', ['profile' => $item->id])}}">
                                {{$item->last_name}}, {{$item->first_name}} {{$item->middle_name}}
                            </a>
                        </td>
                        <td>
                            @if (auth()->user()->role == 'ADMIN')
                            <form method="POST" action="{{route('hh.toggle', ['hh' => $hh->id])}}">
                                @csrf
                                <input type="hidden" name="profile_id" value="{{$item->id}}">
                                <button class="btn btn-danger btn-sm ">REMOVE</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-.main>
