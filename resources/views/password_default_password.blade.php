@component('mail::message')
# Account information
** The following information is your credentials for you to access your personal account. **

Email : {{$user->email}}

Password: {{$password}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
