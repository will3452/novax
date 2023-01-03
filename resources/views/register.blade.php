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
            class="bg-white shadow rounded-lg p-8 max-w-login mx-auto"
            method="POST"
            action="{{ route('register') }}"
            >
            {{ csrf_field() }}

            <h2 class="text-2xl text-center font-normal mb-6 text-90">
                {{ __('REGISTRATION') }}
            </h2>

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
                <input class="form-control form-input form-input-bordered w-full" id="name" type="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password" required>
            </div>

            <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="block font-bold mb-2" for="password">{{ __('Confirm password') }}</label>
                <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password_confirmation" required>
            </div>

            <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
                {{ __('Register') }}
            </button>
            <div class="text-center mt-4">
                <a style="color: #777;" class=" dim font-bold no-underline" href="{{ route('nova.login') }}">
                    {{ __('Already have an account ?') }}
                </a>
            </div>
            </form>

        </div>
    </div>
</body>
</html>
