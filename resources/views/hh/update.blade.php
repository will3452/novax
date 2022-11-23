<x-layouts.main>
    <h1 class="page-header">
        Family House Hold Profile
    </h1>
    <div>
        <form action="{{route('hh.update', ['hh' => $hh->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Details Update
            </div>
            @csrf
            <div class="panel-body">
                <x-input :value="$hh->purok" required="1" name="purok" label="Purok"></x-input>
                <x-boolean :checked="$hh->four_ps" required="1" name="four_ps" label="4 P's"></x-boolean>
                <x-boolean :checked="$hh->nhts" required="1" name="nhts" label="NHTS"></x-boolean>
                <x-input :value="$hh->dialect" required="1" name="dialect" label="Dialect"></x-input>
                <x-input :value="$hh->type_of_dwelling" required="1" name="type_of_dwelling" label="Type of Dwelling"></x-input>
                <x-input :value="$hh->type_of_electricity" required="1" name="type_of_electricity" label="Type of Electricity"></x-input>
                <x-input :value="$hh->source_of_water" required="1" name="source_of_water" label="Source of water"></x-input>
                <x-input :value="$hh->sanitation_facilities" required="1" name="sanitation_facilities" label="Sanitation facilities"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
