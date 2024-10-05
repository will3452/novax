@component('mail::message')
# Status Update

Your appointment is currently {{$status}}. Please let us know if you have any questions or need further assistance.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
