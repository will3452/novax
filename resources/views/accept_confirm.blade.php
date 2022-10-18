@extends('vendor.nova.auth.layout')

@section('content')


<form
    class="rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{ route('access.confirm') }}"
>
<h1 class="mb-4">Request details</h1>
    {{ csrf_field() }}

    <div>
        @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('phone'))
            {{ $errors->first('phone') }}
        @endif
        </p>
    @endif

    <div>
        @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('message'))
            {{ $errors->first('message') }}
        @endif
        </p>
    @endif

    <input type="hidden" name="item_id" value="{{$item->id}}">

    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Register No.') }}</label>
        <input placeholder="09XXXXXXXXX" class="form-control form-input form-input-bordered w-full" id="email" type="number" name="phone" value="{{ old('phone') }}" required autofocus>
    </div>
    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Message') }}</label>
        <textarea name="message" placeholder="Please allow me to access your file." required style="height: 100px" class="form-control form-input form-input-bordered w-full"></textarea>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Submit Request') }}
    </button>
    </div>
</form>
@endsection
