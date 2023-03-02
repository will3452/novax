<x-.main>
    <h1 class="page-header">
        General
    </h1>
    <div>
        <form action="{{route('generals.update', ['general' => $general->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-select :value="$general->profile_id" required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input :value="$general->temp" name="temp" label="Temp"></x-input>
                <x-input :value="$general->bp" name="bp" label="BP"></x-input>
                <x-input :value="$general->hr" name="hr" label="HR"></x-input>
                <x-input :value="$general->pr" name="pr" label="PR"></x-input>
                <x-input :value="$general->o2_level" name="o2_level" label="O2 Level"></x-input>
                <x-textarea :value="$general->chief_complaint" name="chief_complaint" label="Chief Complaint"></x-textarea>
                <x-textarea :value="$general->treatment_management" name="treatment_management" label="Treament/Management"></x-textarea>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
