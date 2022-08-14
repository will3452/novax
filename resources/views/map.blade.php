@extends('layouts.app')

@section('content')
    <vue-map user-id="{{auth()->id()}}"></vue-map>
@endsection
