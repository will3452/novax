@component('mail::message')
# Password reset link

@component('mail::button', ['url' => route('password.reset.link', ['passwordResetLink' => $passwordResetLink->uuid])])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
