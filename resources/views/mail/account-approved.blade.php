@component('mail::message')
# Hello, {{$user->name}}

You're Account has been approved :D !

Thanks,<br>
{{ config('app.name') }}
@endcomponent
