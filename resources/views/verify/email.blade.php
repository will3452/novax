@component('mail::message')
# Verify your account

Verify my account.

@component('mail::button', ['url' => route('account.verify', ['p' => $user->password])])
Verify now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
