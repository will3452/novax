@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <img src="/storage/{{$e->image}}" alt="" class="img-fluid">
        </div>
        <h1 class="text-center my-5">{{$e->name}}</h1>
        @foreach (['instruction', 'equipment', 'duration_and_frequency'] as $item)
        <div class="mt-4">
            <h5 class="p-2 ">{{\Str::title(\Str::plural(\Str::of($item)->whenContains(['_'], function ($string) {
                $arr = explode('_', $string);
                $str = \Str::plural(implode(' ', $arr));
                return $str;
            })))}}</h5>
            <p class="text-sm p-4" style="border: 2px dashed #ddd">
                {{$e[$item]}}
            </p>
        </div>
        @endforeach
        <form action="{{route('progress')}}" method="POST">
            @csrf
            <input type="hidden" value="Exercise" name="type">
            <input type="hidden" value="{{$e->id}}" name="id">
            <input type="hidden" name="alert" value="Record has been recorded to your progress">
            <button class="btn btn-primary">
                TAKE EXERCISE !
            </button>
        </form>

    </div>
@endsection
