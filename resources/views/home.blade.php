@extends('layouts.app')

@section('content')
@if (auth()->user()->verified_at == null)
    <x-verify-account></x-verify-account>
@else

<ol class="breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol>


<div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    Welcome to your dashboard !
</div>

<div class="row g-2">
    <div class="col-md-4 col-12">
        <div class="card " >
            <div class="card-body">
                <h4 class="card-title">BMI Records</h4>
                <p class="card-text">Add BMI record and see progress.</p>
                <a href="{{route('records.index')}}" class="btn btn-primary">VIEW</a>
            </div>
            </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="card " >
            <div class="card-body">
                <h4 class="card-title">Foods</h4>
                <p class="card-text">Check out different foods that are appropriate for your health.</p>
                <a href="{{route('foods.index')}}" class="btn btn-primary">VIEW</a>
            </div>
            </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="card " >
            <div class="card-body">
                <h4 class="card-title">Exercises</h4>
                <p class="card-text">Exercises that will reinforce your body.</p>
                <a href="{{route('exercises.index')}}" class="btn btn-primary">VIEW</a>
            </div>
            </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="card " >
            <div class="card-body">
                <h4 class="card-title">Activities / Progress</h4>
                <p class="card-text">Check your daily progress here.</p>
                <a href="{{route('activities.index')}}" class="btn btn-primary">VIEW</a>
            </div>
            </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="card " >
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <p class="card-text">Organize or change your profile.</p>
                <a href="{{route('profiles.show', ['user' => auth()->id()])}}" class="btn btn-primary">VIEW</a>
            </div>
            </div>
    </div>
</div>
@endif
@endsection
