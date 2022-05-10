@component('mail::message')
# Your Temporary Password

Your temporary password is : {{ $password }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
