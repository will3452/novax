@extends('vendor.nova.auth.layout')

@section('content')


<form
    class="rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{ route('check.otp') }}"
>
    {{ csrf_field() }}

    <div>
        @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('otp'))
            {{ $errors->first('otp') }}
        @endif
        </p>
    @endif

    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('OTP code') }}</label>
        <input placeholder="XXXXXX" class="form-control form-input form-input-bordered w-full" id="email" type="number" name="otp" value="{{ old('otp') }}" required autofocus>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Submit') }}
    </button>
    </div>
</form>
@endsection
