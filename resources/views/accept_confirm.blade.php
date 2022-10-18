@extends('vendor.nova.auth.layout')

@section('content')


<form
    class="rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{ route('accept.request') }}"
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

    <input type="hidden" name="id" value="{{$sharedRequest->id}}">

    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Requestor') }}</label>
        <input placeholder="09XXXXXXXXX" disabled class="form-control disabled form-input form-input-bordered w-full" id="email" type="text"  value="{{ $requestor->name }}" required autofocus>
    </div>
    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Message') }}</label>
        <textarea placeholder="Please allow me to access your file." required style="height: 100px" class="form-control form-input form-input-bordered w-full disabled" disabled>{{$sharedRequest->message}}</textarea>
    </div>

    <div class="mb-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Requested File') }}</label>
        <input placeholder="09XXXXXXXXX" disabled class="form-control disabled form-input form-input-bordered w-full" id="email" type="text"  value="{{ $item->name }}" required autofocus>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Approve Request') }}
    </button>
    </div>
</form>
@endsection
