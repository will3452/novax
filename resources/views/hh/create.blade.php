<x-.main>
    <h1 class="page-header">
        Family House Hold Profile
    </h1>
    <div>
        <form action="{{route('hh.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Family Household profile Form
            </div>
            @csrf
            <div class="panel-body">
                <x-input required="1" name="purok" label="Purok"></x-input>
                <x-boolean required="1" name="four_ps" label="4 P's"></x-boolean>
                <x-boolean required="1" name="nhts" label="NHTS"></x-boolean>
                <x-input required="1" name="dialect" label="Dialect"></x-input>
                <x-input required="1" name="type_of_dwelling" label="Type of Dwelling"></x-input>
                <x-input required="1" name="type_of_electricity" label="Type of Electricity"></x-input>
                <x-input required="1" name="source_of_water" label="Source of water"></x-input>
                <x-input required="1" name="sanitation_facilities" label="Sanitation facilities"></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
