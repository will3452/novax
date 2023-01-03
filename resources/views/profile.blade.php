<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">


    <!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
</head>
<body class="bg-40 text-black h-full">
    <div class="h-full">
        <div class="px-view py-view mx-auto">
            <form
            class="bg-white shadow rounded-lg p-8  mx-auto w-full"
            method="POST"
            action="{{ route('profile') }}"
            enctype="multipart/form-data"
            >

            {{ csrf_field() }}

            <h2 class="text-2xl text-center font-normal mb-6 text-90">
                {{ __('Profile Information') }}
            </h2>


            @if (session()->has('success'))
                <p class="text-success">
                    Updated successfully!
                </p>
            @endif

            <h4 class="text-right font-normal">Account</h4>

            @if ($errors->any())
            <p class="text-center font-semibold text-danger my-3">
                @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                @else
                    {{ $errors->first('password') }}
                @endif
                </p>
            @endif

            <div class="mb-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="name">{{ __('Name') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="name" type="name" name="name" value="{{ old('name') ?? auth()->user()->name }}" required >
            </div>

            <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
                <input class="form-control form-input form-input-bordered w-full" disabled id="email" type="email" name="email" value="{{ old('email') ?? auth()->user()->email }}" required >
            </div>

            <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password" required>
            </div>

            <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="password">{{ __('Confirm password') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password_confirmation" required>
            </div>

            <h4 class="text-right font-normal">Personal Information</h4>

            <div class="mb-6 {{ $errors->has('educational_level') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="educational_level">{{ __('Educational Level') }}</label>
                <select class="form-control form-input form-input-bordered w-full" id="educational_level" name="educational_level" required value="{{optional(auth()->user()->profile)->educational_level}}">
                    <option value="k-12">K-12</option>
                    <option value="College">College</option>
            </select>
            </div>

            <div class="mb-6 {{ $errors->has('school') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="school">{{ __('School') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="school" type="text"
                value="{{optional(auth()->user()->profile)->school ?? ''}}"
                name="school" required>
            </div>

            <div class="mb-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="address">{{ __('Address') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="address" type="text"
                value="{{optional(auth()->user()->profile)->address ?? ''}}"
                placeholder="eg. Prk.2 - San Juan, Manila" name="address" required>
            </div>

            <div class="mb-6 {{ $errors->has('id_1') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="id_1">{{ __('2 VALID IDs') }}</label>
                <input id="number" type="file"
                accept="image/*"
                class="block"
                value="{{optional(auth()->user()->profile)->id_1 ?? ''}}" name="id_1" required>
                <input id="number" type="file"
                accept="image/*"
                class="block mt-4"
                value="{{optional(auth()->user()->profile)->id_2 ?? ''}}" name="id_2" required>
            </div>

            <div class="mb-6 {{ $errors->has('mothers_name') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="mothers_name">{{ __('Mother\'s Name') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="mothers_name" type="text"
                value="{{optional(auth()->user()->profile)->mothers_name ?? ''}}" name="mothers_name" required>
            </div>

            <div class="mb-6 {{ $errors->has('fathers_name') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="fathers_name">{{ __('Father\'s Name') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="fathers_name" type="text"
                value="{{optional(auth()->user()->profile)->fathers_name ?? ''}}" name="fathers_name" required>
            </div>

            <div class="mb-6 {{ $errors->has('work') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="work">{{ __('Work') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="work" type="text"
                value="{{optional(auth()->user()->profile)->work ?? ''}}" name="work" required>
            </div>



            <div class="mb-6 {{ $errors->has('monthly_salary') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="monthly_salary">{{ __('Monthly Salary') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="number" type="number"
                value="{{optional(auth()->user()->profile)->monthly_salary ?? ''}}"
                placeholder="eg. 8,000" name="monthly_salary" required>
            </div>

            <div class="mb-6 {{ $errors->has('company') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="company">{{ __('Company/Employer Name') }} (optional) </label>
                <input class="form-control form-input form-input-bordered w-full" id="company" type="text"
                value="{{optional(auth()->user()->profile)->company ?? ''}}" name="company">
            </div>


            <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
                {{ __('Save Profile') }}
            </button>
            <div class="text-center mt-4">
                <a style="color: #777;" class=" dim font-bold no-underline" href="{{ route('nova.login') }}">
                    {{ __('Back to Dashboard') }}
                </a>
            </div>
            </form>

        </div>
    </div>
</body>
</html>
