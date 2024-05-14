@component('mail::message')
# Booking update

Dear patient, 
We hope this message finds you well. We are writing to update you on the status of your booking.

Booking Details:

Booking Number: {{$booking->reference}}

Service/Product: {{$booking->service->name}}

Date & time: {{$booking->date}}, {{$booking->time}}

Current Status: {{$booking->status}}

@component('mail::button', ['url' => route('nova.login')])
Proceed to app
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
