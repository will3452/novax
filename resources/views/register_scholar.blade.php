<x-layout>
    <x-header>
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" style="width:200px !important;">
    </x-header>
    <x-container>
       <div class="w-11/12 md:w-8/12 mx-auto">
         <form action="/register" method="POST" enctype="multipart/form-data">
            @csrf
             <x-vspace>
                <x-form-input name="aan" label="AAN" is-required="true">
                    <x-link href="/contact-form">I have no AAN.</x-link>
                </x-form-input>
             </x-vspace>
             <x-vspace>
                <x-form-input type="select" name="role" is-required="true" label="Register As"
                :options="[
                    [
                        'label' => \App\Models\User::ROLE_AUTHOR,
                        'value' => \App\Models\User::ROLE_AUTHOR,
                   ],
                   [
                        'label' => \App\Models\User::ROLE_ARTIST,
                        'value' => \App\Models\User::ROLE_ARTIST,
                    ],
                    ]"
                ></x-form-input>
            </x-vspace>
             <x-vspace>
                <x-form-input name="first_name" label="First Name" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="last_name" label="Last Name" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="user_name" label="User Name" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input
                 type="select"
                 label="Gender"
                 name="gender"
                 is-required="true"
                 :options="[
                     [
                         'label' => \App\Models\User::GENDER_FEMALE,
                         'value' => \App\Models\User::GENDER_FEMALE,
                    ],
                    [
                         'label' => \App\Models\User::GENDER_MALE,
                         'value' => \App\Models\User::GENDER_MALE,
                    ],
                    [
                         'label' => \App\Models\User::GENDER_LGBT,
                         'value' => \App\Models\User::GENDER_LGBT,
                    ],
                 ]"
                 ></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input type="select" name="sex" label="Sex" is-required="true"
                 :options="[
                    [
                        'label' => \App\Models\User::GENDER_FEMALE,
                        'value' => \App\Models\User::GENDER_FEMALE,
                   ],
                   [
                        'label' => \App\Models\User::GENDER_MALE,
                        'value' => \App\Models\User::GENDER_MALE,
                   ],
                   [
                        'label' => \App\Models\User::GENDER_LGBT,
                        'value' => \App\Models\User::GENDER_LGBT,
                   ],
                ]"
                 ></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="address" label="Complete Address" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input
                 name="country"
                 label="Country"
                 is-required="true"
                 type="select"
                 :options="\App\Helpers\CountryHelper::getAllCountriesForSelect()"
                 ></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input
                 type="text"
                 name="city"
                 is-required="true"
                 label="City"
                 ></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input type="file" name="picture" label="Picture" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="birth_date" type="date" label="Birthdate" is-required="true" help="You must be 15 years old or above to register and use this site."></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="email" type="email" label="Email" is-required="true"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input name="password" type="password" is-required="true" type="password" label="Password">
                 </x-form-input>
             </x-vspace>
             <x-vspace>
                 <x-form-input is-required="true" name="password_confirmation" type="password" label="Re-type Password"></x-form-input>
             </x-vspace>
             <x-vspace>
                 <the-interest></the-interest>
             </x-vspace>
             @foreach (App\Models\FormCheck::get() as $check)
                <x-vspace>
                    <x-check :check="$check"></x-check>
                </x-vspace>
             @endforeach
             <div class="flex justify-between w-8/12 ml-auto">
                <a href="{{Nova::path()}}" class="text-xs underline text-gray-700 font-bold p-2" type="submit">
                    ALREADY HAVE AN ACOUNT?
                </a>
                <button class="bg-purple-900 text-white font-bold p-2" type="submit">
                    REGISTER NOW
                </button>
             </div>
         </form>
       </div>
    </x-container>
</x-layout>
