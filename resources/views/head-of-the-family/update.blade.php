<x-layouts.main>
    <h1 class="page-header">
        Head of the family
    </h1>
    <div>
        <form action="{{route('headOfTheFamilies.update', ['headOfTheFamily' => $headOfTheFamily->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-select :value="$pregnant->profile_id" required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>

                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
