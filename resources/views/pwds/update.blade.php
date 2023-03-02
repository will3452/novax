<x-.main>
    <h1 class="page-header">
        PWD
    </h1>
    <div>
        <form action="{{route('pwd.update', ['pwd' => $pwd->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-select required="1"  :value="$pwd->profile_id" name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-input name="pwd_id" :value="$pwd->pwd_id" label="PWD ID"></x-input>
                <x-input name="type_of_disability" :value="$pwd->type_of_disability" label="Type of disability"></x-input>
                <x-input name="remarks" :value="$pwd->remarks" label="remarks"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
