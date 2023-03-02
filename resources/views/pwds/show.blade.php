<x-.main>
    <h1 class="page-header">
        PWD
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">PWD Details</div>
        <div class="panel-body">
            <x-description label="Profile" value="{{$pwd->profile->last_name}}, {{$pwd->profile->first_name}} {{$pwd->profile->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $pwd->profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
            <x-description label="PWD ID" :value="$pwd->pwd_id"></x-description>
            <x-description label="Type of Disability" :value="$pwd->type_of_disability"></x-description>
            <x-description label="Remarks" :value="$pwd->remarks"></x-description>


        </div>
    </div>
</x-.main>
