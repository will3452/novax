<x-.main>
    <h1 class="page-header">
        Children
    </h1>
    <div>
        <form action="{{route('children.update', ['children' => $children->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-select :value="$children->mother_profile_id" required="1"  name="mother_profile_id" label="Please Select Mother Profile" :option-value="$mothers->pluck('id')" :option-label='$mothers->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-select :value="$children->child_profile_id" required="1"  name="child_profile_id" label="Please Select Child Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input :value="$children->wt" required="1" name="wt" label="Wt"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
