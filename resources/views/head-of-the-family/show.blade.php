<x-layouts.main>
    <h1 class="page-header">
        Head of the family
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Details</div>
        <div class="panel-body">
            <x-description label="Profile" value="{{$headOfTheFamily->profile->last_name}}, {{$headOfTheFamily->profile->first_name}} {{$headOfTheFamily->profile->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $headOfTheFamily->profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
        </div>
    </div>
</x-layouts.main>
