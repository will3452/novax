<x-.main>
    <h1 class="page-header">
        Profile
    </h1>
    <div>
        <form action="{{route('profiles.index')}}" class="panel panel-default" method="POST">
            <div class="panel-heading ">
                Profile Form
            </div>
            @csrf
            <div class="panel-body">
                <x-input required="1" name="first_name" label="First Name"></x-input>
                <x-input required="1" name="last_name" label="Last Name"></x-input>
                <x-input required="0" name="middle_name" label="Middle Name"></x-input>
                <x-input required="1" type="date" name="birthdate" label="Birthdate"></x-input>
                <x-boolean required="1" name="sex" label="Sex" yesText="Male" noText="Female" yesValue="Male" noValue="Female"></x-boolean>
                <x-input required="1" type="number" name="cpno" label="CP #"></x-input>
                <x-input required="1" name="purok" label="Purok"></x-input>
                <x-input required="0" name="religion" label="Religion"></x-input>
                <div class="form-group">
                    <label>Civil Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="civil_status" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Windowed">Windowed</option>
                    </select>
                </div>

                <x-input required="0" name="education_attainment" label="Education Attainment"></x-input>
                <x-input required="0" name="occupation" label="Occupation"></x-input>
                <x-boolean required="1" name="smoker" label="Smoker"></x-boolean>
                <x-boolean required="1" name="hypertension" label="Hypertension"></x-boolean>
                <x-boolean required="1" name="alcohol_drinker" label="Alcohol Drinker"></x-boolean>
                <x-boolean required="1" name="diabetes" label="Diabetes"></x-boolean>
                <x-boolean required="1" name="pwd" label="PWD"></x-boolean>
                <x-input required="0" name="phic_membership" label="PHIC membership" help="If yes please indicate the number above."></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-.main>
