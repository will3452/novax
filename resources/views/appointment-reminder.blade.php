@component('mail::message')

This is a friendly reminder of your upcoming appointment with {{nova_get_setting('doctor_name', 'dr. Dre')}} at {{{nova_get_setting('clinic', 'clinic X')}}}.

Appointment Details:

- Date: {{$app->date->format('m/d/y')}}
- Time: {{$app->time_start}} - {{$app->time_end}}

Please arrive 10-15 minutes before your appointment time to complete any necessary paperwork. If you need to reschedule or cancel, kindly let us know at least 24 hours in advance by contacting us at {{nova_get_setting('contact', '911')}}.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
