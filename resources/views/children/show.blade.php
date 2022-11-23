<x-layouts.main>
    <h1 class="page-header">
        Children
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Child Details</div>
        <div class="panel-body">
            <x-description label="Mother" value="{{$children->mother->last_name}}, {{$children->mother->first_name}} {{$children->mother->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $children->mother_profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
            <x-description label="Child" value="{{$children->child->last_name}}, {{$children->child->first_name}} {{$children->child->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $children->child_profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>

            <x-description label="Wt" :value="$children->wt"></x-description>
        </div>
    </div>
</x-layouts.main>
