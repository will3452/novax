<x-layouts.main>
    <h1 class="page-header">
        Pregnant
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Pregnant Details</div>
        <div class="panel-body">
            <x-description label="Profile" value="{{$pregnant->profile->last_name}}, {{$pregnant->profile->first_name}} {{$pregnant->profile->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $pregnant->profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
            <x-description label="Husband" :value="$pregnant->husband"></x-description>
            <x-description label="LMP" :value="$pregnant->lmp"></x-description>
            <x-description label="BP" :value="$pregnant->bp"></x-description>
            <x-description label="EDC" :value="$pregnant->edc"></x-description>
            <x-description label="GP" :value="$pregnant->gp"></x-description>
            <x-description label="Wt" :value="$pregnant->wt"></x-description>
        </div>
    </div>
</x-layouts.main>
