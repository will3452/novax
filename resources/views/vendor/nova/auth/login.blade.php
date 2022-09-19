@extends('nova::auth.layout')

@section('content')


<div class="p-8" >

    @include('nova::auth.partials.header')
    <form
        class="bg-white p-8 max-w-login mx-auto"
        method="POST"
        action="{{ route('nova.login') }}"
    >
        {{ csrf_field() }}
    {{--
        @component('nova::auth.partials.heading')
            {{ __('Welcome to findie!') }}
        @endcomponent --}}

        @if ($errors->any())
        <p class="text-center font-semibold text-danger my-3">
            @if ($errors->has('email'))
                {{ $errors->first('email') }}
            @else
                {{ $errors->first('password') }}
            @endif
            </p>
        @endif

        <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
            <input class="form-control form-input form-input-bordered w-full rounded-none" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
            <input class="form-control form-input form-input-bordered w-full rounded-none" id="password" type="password" name="password" required>
        </div>

        {{-- <div class="flex mb-6">
            <label class="flex items-center text-xl font-bold">
                <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="text-base ml-2">{{ __('Remember Me') }}</span>
            </label>


            @if (\Laravel\Nova\Nova::resetsPasswords())
            <div class="ml-auto">
                <a class="text-primary dim font-bold no-underline" href="{{ route('nova.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </div> --}}

        <div class="text-center">
            <button class="rounded-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
                {{ __('Login') }}
            </button>
        </div>
        <div class="text-center text-xs my-4">
            or
        </div>
        <div class="text-center mt-4">
            <a href="/register" class="rounded-full btn btn-link " type="submit">
                {{ __('Register now') }}
            </a>
        </div>
    </form>
</div>
@endsection
