<x-layouts.main>
    <h1 class="page-header">
        Profile
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Information</div>
        <div class="panel-body">
            <x-description label="Full Name" value="{{$profile->last_name}}, {{$profile->first_name}} {{$profile->middle_name}}"></x-description>
            <x-description label="Civil Status" value="{{$profile->civil_status}}"></x-description>
            <x-description label="Date of birth" value="{{$profile->birthdate}}"></x-description>
            <x-description label="Phone No." value="{{$profile->cpno}}"></x-description>
            <x-description label="Sex" value="{{$profile->sex}}"></x-description>
            <x-description label="Religion" value="{{$profile->religion}}"></x-description>
            <x-description label="Purok" value="{{$profile->purok}}"></x-description>
            <x-description label="Occupation" value="{{$profile->occupation}}"></x-description>
            <x-description label="Education Attainment" value="{{$profile->education_attainment}}"></x-description>
            <x-description label="PHIC Membership No. " value="{{$profile->phic_membership}}"></x-description>
            <x-description label="PWD" value="{{$profile->pwd ? 'Yes': 'No'}}"></x-description>
            <x-description label="Smoker" value="{{$profile->smoker ? 'Yes': 'No'}}"></x-description>
            <x-description label="Alcohol Drinker" value="{{$profile->alcohol_drinker ? 'Yes': 'No'}}"></x-description>
            <x-description label="Hypertension" value="{{$profile->hypertension ? 'Yes': 'No'}}"></x-description>
            <x-description label="Diabetes" value="{{$profile->diabetes ? 'Yes': 'No'}}"></x-description>
        </div>
    </div>
</x-layouts.main>
