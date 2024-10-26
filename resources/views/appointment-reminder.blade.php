@component('mail::message')

Hello {{$app->patient->name}},

This is a friendly reminder of your upcoming appointment with {{nova_get_setting('doctor_name', 'dr. Dre')}} at {{{nova_get_setting('clinic', 'clinic X')}}}.

Appointment Details:

- Date: {{$app->date->format('m/d/y')}}
- Time: {{$app->slot}}

Please arrive 10-15 minutes before your appointment time to ensure a smooth check-in and to complete any other necessary steps before seeing the dentist.


If you have any questions or need to reschedule, kindly let us know at least 24 hours in advance. You can do this easily by visiting our website or contacting us at {{nova_get_setting('contact', '911')}}.

Please note: This is an automated email, and replies to this message are not monitored. For any inquiries, kindly use the contact details above.


Thank you, and we look forward to seeing you!

Warm regards,
{{ config('app.name') }}
@endcomponent
