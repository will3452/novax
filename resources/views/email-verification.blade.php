@component('mail::message')
# Verify account

Thank you for creating an account with us. To complete your registration, please click the button below.

@component('mail::button', ['url' => url()->signedRoute('account_verify', ['id' => $user->id])])
Verify account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
