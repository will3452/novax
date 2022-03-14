@component('mail::message')
# Account information

Your account has been created!
Your password is: {{$password}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
