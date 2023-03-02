<x-layouts.main>
    <h1 class="page-header">
        Pregnants
    </h1>
    <div>
        <form action="{{route('headOfTheFamilies.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Head of the family
            </div>
            @csrf
            <div class="panel-body">
                <x-select required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>

                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
