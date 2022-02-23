@component('mail::message')
# Hello
System Generated password: {{$password}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
