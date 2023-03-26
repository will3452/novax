@extends('auth.layout')

@section('content')
<h1 class="text-center mb-4">Create new account</h1>
<form
    class=" max-w-login mx-auto"
    method="POST"
    action="/register"
>
    {{ csrf_field() }}

    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="text-red-200">
                {{$item}}
            </div>
        @endforeach
    @endif


    @if (session()->get('succes'))
        <div class="p-2 bg-success rounded text-white text-center">
            Registration Success!
        </div>
    @endif


    <div class="mb-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="name">{{ __('First Name') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
    </div>
    <div class="mb-6 {{ $errors->has('middle_name') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="middle_name">{{ __('Middle Name') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="name" type="text" name="middle_name" value="{{ old('middle_name') }}" required autofocus>
    </div>
    <div class="mb-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="last_name">{{ __('Last Name') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>
    </div>
    <div class="mb-6 {{ $errors->has('suffix') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="suffix">{{ __('Suffix') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="name" type="text" name="suffix" value="{{ old('suffix') }}"  autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="address">{{ __('Address') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="address" type="text" name="address" value="{{ old('address') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('birthdate') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="birthdate">{{ __('Birhtday') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="birthdate" type="date" name="birthdate" value="{{ old('birthdate') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('sex') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="sex">{{ __('Sex') }}</label>
        <select class="form-control form-input form-input-bordered w-full" id="sex" type="text" name="sex" value="{{ old('sex') }}" required>
            <option value="male">male</option>
            <option value="female">female</option>
        </select>
    </div>

    <div class="mb-6 {{ $errors->has('contact_no') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="contact_no">{{ __('Mobile No.') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="contact_no" type="text" name="contact_no" value="{{ old('contact_no') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password" required>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="password">{{ __('Confirm Password') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password_confirmation" required>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Register') }}
    </button>
</form>
@endsection
