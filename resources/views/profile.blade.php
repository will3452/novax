@extends('layouts.app')

@section('content')
    <a-card>
        <form method="POST" action="/profile">
            @csrf
            @if (session()->get('success'))
                <a-alert type="success" closable="1" message="Changes saved!"></a-alert>
            @endif
            <div>
                <label for="name" class=" col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name ?? old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class=" col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="">
                    <input disabled id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email ??  old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class=" col-form-label text-md-end">{{ __('Mobile No.') }}</label>

                <div class="">
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{auth()->user()->mobile ??  old('mobile') }}" required autocomplete="mobile">

                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class=" col-form-label text-md-end">{{ __('New Password') }}</label>

                <div class="">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm" class=" col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <div class="">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">
                {{ __('Save changes') }}
            </button>
        </form>
    </a-card>
@endsection
