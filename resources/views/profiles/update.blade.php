<x-layouts.main>
    <h1 class="page-header">
        Profile
    </h1>
    <div>
        <form action="{{route('profiles.update', ['profile' => $profile->id])}}" class="panel panel-default" method="POST">
            @method('PUT')
            <div class="panel-heading ">
                Profile Update
            </div>
            @csrf
            <div class="panel-body">
                <x-input  :value="$profile->first_name" required="1" name="first_name" label="First Name"></x-input>
                <x-input  :value="$profile->last_name" required="1" name="last_name" label="Last Name"></x-input>
                <x-input  :value="$profile->middle_name" required="0" name="middle_name" label="Middle Name"></x-input>
                <x-input  :value="$profile->birthdate" required="1" type="date" name="birthdate" label="Birthdate"></x-input>
                <x-boolean :checked="$profile->sex"  required="1" name="sex" label="Sex" yesText="Male" noText="Female" yesValue="Male" noValue="Female"></x-boolean>
                <x-input  :value="$profile->cpno" required="1" type="number" name="cpno" label="CP #"></x-input>
                <x-input  :value="$profile->purok" required="1" name="purok" label="Purok"></x-input>
                <x-input  :value="$profile->religion" required="0" name="religion" label="Religion"></x-input>
                <div class="form-group">
                    <label>Civil Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="civil_status" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Windowed">Windowed</option>
                    </select>
                </div>

                <x-input  :value="$profile->education_attainment" required="0" name="education_attainment" label="Education Attainment"></x-input>
                <x-input  :value="$profile->occupation" required="0" name="occupation" label="Occupation"></x-input>
                <x-boolean :checked="$profile->smoker"  required="1" name="smoker" label="Smoker"></x-boolean>
                <x-boolean :checked="$profile->hypertension"  required="1" name="hypertension" label="Hypertension"></x-boolean>
                <x-boolean :checked="$profile->alcohol_drinker"  required="1" name="alcohol_drinker" label="Alcohol Drinker"></x-boolean>
                <x-boolean :checked="$profile->diabetes"  required="1" name="diabetes" label="Diabetes"></x-boolean>
                <x-boolean :checked="$profile->pwd"  required="1" name="pwd" label="PWD"></x-boolean>
                <x-input  :value="$profile->phic_membership" required="0" name="phic_membership" label="PHIC membership" help="If yes please indicate the number above."></x-input>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.main>
