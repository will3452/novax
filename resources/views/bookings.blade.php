@extends('layouts.app')

@section('content')
    <h1>Bookings</h1>
    <booking-list user-id="{{auth()->id()}}"></booking-list>
@endsection
