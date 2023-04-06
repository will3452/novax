@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        Feeds: {{auth()->user()->posts()->count()}}
    </div>
</div>
@endsection
