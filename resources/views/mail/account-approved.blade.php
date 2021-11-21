@component('mail::message')
# Hello, {{$user->name}}

Your Cloud Accouting System account registration application has been duly APPROVED!

You can now login and start using Cloud Accounting System for SMEs.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
