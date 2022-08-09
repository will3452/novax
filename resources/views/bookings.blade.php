@extends('layouts.app')

@section('content')
    <booking-card user-id="{{auth()->id()}}"></booking-card>
    <booking-list user-id="{{auth()->id()}}"></booking-list>
@endsection
