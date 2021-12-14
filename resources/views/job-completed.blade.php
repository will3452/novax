@component('mail::message')
# Notifications

Job has been completed, today {{now()->format('m-d-Y')}}!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
