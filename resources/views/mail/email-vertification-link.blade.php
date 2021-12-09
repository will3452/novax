@component('mail::message')
# Email Verification Link

Hello {{$user->name}}, Welcome to the {{config('app.name')}}, Please Hit the button below to verify your registered email.

@component('mail::button', ['url' => $link])
Verify Now
@endcomponent

if the above button is not working, Please refer to this Uri : {{$link}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
