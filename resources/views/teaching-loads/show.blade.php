@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('tl.index')}}">Teaching loads</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-4">
            <x-load-item :item="$load"></x-load-item>
        </div>
    </div>
@endsection
