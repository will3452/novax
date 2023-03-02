<x-.main>
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
                <x-select required="1"  name="profile_id" label="Please Select Profile" :option-value="$profiles->pluck('id')" :option-label='$profiles->map(fn ($item, $key) => "$item->last_name, $item->first_name $item->middle_name")'></x-select>
                <x-boolean :value="$healthProblem->HPN" required="1" name="HPN" label="HPN"></x-boolean>
                <x-boolean :value="$healthProblem->CVD" required="1" name="CVD" label="CVD"></x-boolean>
                <x-boolean :value="$healthProblem->cancer" required="1" name="cancer" label="Cancer"></x-boolean>
                <x-boolean :value="$healthProblem->renal" required="1" name="renal" label="Renal/Kidney Disease"></x-boolean>
                <x-boolean :value="$healthProblem->diabetes" required="1" name="diabetes" label="Diabetes"></x-boolean>
                <x-boolean :value="$healthProblem->TB" required="1" name="TB" label="TB"></x-boolean>
                <x-boolean :value="$healthProblem->goiter" required="1" name="goiter" label="Goiter"></x-boolean>
                <x-input :value="$healthProble->others" required="0" name="others" label="Others"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
