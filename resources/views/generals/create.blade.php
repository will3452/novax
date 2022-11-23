<x-layouts.main>
    <h1 class="page-header">
        General
    </h1>
    <div>
        <form action="{{route('generals.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Generic Form
            </div>
            @csrf
            <div class="panel-body">
                <x-select required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input name="temp" label="Temp"></x-input>
                <x-input name="bp" label="BP"></x-input>
                <x-input name="hr" label="HR"></x-input>
                <x-input name="pr" label="PR"></x-input>
                <x-input name="o2_level" label="O2 Level"></x-input>
                <x-textarea name="chief_complaint" label="Chief Complaint"></x-textarea>
                <x-textarea name="treatment_management" label="Treament/Management"></x-textarea>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
