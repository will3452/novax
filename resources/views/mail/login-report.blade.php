@component('mail::message')
# Login Report

Hello, {{$name}}

The purpose of thios message is to notify you that you have logged into the application.

Datetime: {{now()}}
IP address: {{$ip}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
