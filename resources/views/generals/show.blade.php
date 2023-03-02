<x-.main>
    <h1 class="page-header">
        General
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Generic Information</div>
        <div class="panel-body">
            <x-description label="Profile" value="{{$general->profile->last_name}}, {{$general->profile->first_name}} {{$general->profile->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $general->profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
            <x-description label="Temp" :value="$general->temp"></x-description>
            <x-description label="BP" :value="$general->bp"></x-description>
            <x-description label="HR" :value="$general->hr"></x-description>
            <x-description label="PR" :value="$general->pr"></x-description>
            <x-description label="O2 Level" :value="$general->o2_level"></x-description>
            <x-description label="Chief Complaint" :value="$general->chief_complaint"></x-description>
            <x-description label="Treatment/Management" :value="$general->treatment_management"></x-description>
        </div>
    </div>
</x-.main>
