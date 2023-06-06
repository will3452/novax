@component('mail::message')
# Appointment Status
Dear {{ $user->name }},
    We're pleased to inform you, that your Appointment has been approved.
here are the details.


**Queue #** --- {{ $line }}

**Date** --- {{ \Carbon\Carbon::parse($appointment->date)->format('m/d/Y') }}

**Time** --- {{ $appointment->time}}

Scan the code to pay  PHP {{ nova_get_setting('appointment_fee')}}
![]({{ url('/storage/' . nova_get_setting('qr')) }})


@component('mail::button', ['url' => url('/')])
ATTACH RECEIPT TO YOUR APPOINTMENT
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
