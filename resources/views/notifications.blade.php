@extends('layouts.app')

@section('content')
    <notifications user-id="{{auth()->id()}}"></notifications>
@endsection
