@extends('nova::auth.layout')

@section('content')

@include('nova::auth.partials.header')

@component('nova::auth.partials.heading')
{{ config('app.name') }}
@endcomponent


<form
    class="rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{ route('login.sms') }}"
>
    {{ csrf_field() }}

    <div>
        @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('phone'))
            {{ $errors->first('phone') }}
        @endif
        </p>
    @endif

    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Register Mobile #') }}</label>
        <input placeholder="09" class="form-control form-input form-input-bordered w-full" id="email" type="number" name="phone" value="{{ old('phone') }}" required autofocus>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Login') }}
    </button>
    </div>
</form>
@endsection
