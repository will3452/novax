<x-layouts.main>
    <h1 class="page-header">
        PWD
    </h1>
    <div>
        <form action="{{route('pwd.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                PWD Form
            </div>
            @csrf
            <div class="panel-body">
                <x-select required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input name="pwd_id" label="PWD ID"></x-input>
                <x-input name="type_of_disability" label="Type of disability"></x-input>
                <x-input name="remarks" label="remarks"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
