@component('mail::message')
# Hello, Here's your Code.

{{$otp->otp}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
