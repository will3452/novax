<x-layouts.main>
    <h1 class="page-header">
        General
    </h1>
    <div>
        <form action="{{route('pregnants.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Pregnant Form
            </div>
            @csrf
            <div class="panel-body">
                <x-select required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input name="lmp" label="LMP"></x-input>
                <x-input name="edc" label="EDC"></x-input>
                <x-input name="gp" label="GP"></x-input>
                <x-input name="wt" label="Wt"></x-input>
                <x-input name="bp" label="BP"></x-input>
                <x-input name="husband" label="husband" required="1"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
