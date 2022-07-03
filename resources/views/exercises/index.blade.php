@extends('layouts.app')
@section('content')
    <h1 class="text-center">Exercises</h1>
    <div class="container">
        <form action="" class="d-flex">
            <input name="keyword" type="text" class="form-control" placeholder="Search Exercise">
            <button class="btn btn-primary mx-2">Search</button>
        </form>
        @if (request()->has('keyword'))
            <h3 class="alert alert-warning mt-5">keyword: "<span style="font-style: italic">{{request()->keyword}}</span>"</h3>
        @endif
    </div>

    <div class="container mt-5">
        @foreach ($exercises as $item)
        <div class="row my-4">
            <div class="col-md-4">
                <img src="/storage/{{$item->image}}" alt="" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h4>{{$item->name}}</h4>
                <h5>{{$item->duration_and_frequency}}</h5>
                <p>{{\Str::limit($item->instruction, 400)}}</p>
                <a class="btn btn-primary" href="{{route('exercises.show', ['e' => $item->id])}}">show details</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
