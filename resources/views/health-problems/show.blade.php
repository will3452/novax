<x-.main>
    <h1 class="page-header">
        Health problems
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Details</div>
        <div class="panel-body">
            <x-description label="Profile" value="{{$healthProblem->profile->last_name}}, {{$healthProblem->profile->first_name}} {{$healthProblem->profile->middle_name}}">
                <a href="{{route('profiles.show', ['profile' => $healthProblem->profile_id])}}" class="text-primary "><i class="fa fa-link"></i> view</a>
            </x-description>
            <x-description label="HPN" value="{{$healthProblem->HPN == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="CVD" value="{{$healthProblem->CVD == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="cancer" value="{{$healthProblem->cancer == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="renal / Kindney" value="{{$healthProblem->renal == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="diabetes" value="{{$healthProblem->diabetes == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="TB" value="{{$healthProblem->TB == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="goiter" value="{{$healthProblem->goiter == 1 ? 'Yes': 'No'}}"></x-description>
            <x-description label="others" value="{{$healthProblem->others }}"></x-description>
        </div>
    </div>
</x-.main>
