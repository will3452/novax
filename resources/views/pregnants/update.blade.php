<x-layouts.main>
    <h1 class="page-header">
        Pregnant
    </h1>
    <div>
        <form action="{{route('pregnants.update', ['pregnant' => $pregnant->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-select :value="$pregnant->profile_id" required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input :value="$pregnant->lmp"  name="lmp" label="LMP"></x-input>
                <x-input :value="$pregnant->edc"  name="edc" label="EDC"></x-input>
                <x-input :value="$pregnant->gp"  name="gp" label="GP"></x-input>
                <x-input :value="$pregnant->wt"  name="wt" label="Wt"></x-input>
                <x-input :value="$pregnant->bp"  name="bp" label="BP"></x-input>
                <x-input :value="$pregnant->husband"  name="husband" label="husband" required="1"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
