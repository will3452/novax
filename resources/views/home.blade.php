@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <x-d-card>
            <img class="dashboard-icon" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-meals-new-normal-flaticons-lineal-color-flat-icons-2.png"/>
            <div class="text-center">
                Meals
            </div>
        </x-d-card>
        <x-d-card>
            <img class="dashboard-icon" src="https://img.icons8.com/bubbles/100/000000/exercise.png"/>
            <div class="text-center">
                Exercises
            </div>
        </x-d-card>
        <x-d-card>
            <img class="dashboard-icon" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-progress-achievements-flaticons-lineal-color-flat-icons-2.png"/>
            <div class="text-center">
                Progress
            </div>
        </x-d-card>
        <x-d-card>
            <img class="dashboard-icon" src="https://img.icons8.com/office/80/000000/estimate.png"/>
            <div class="text-center">
                Calculator
            </div>
        </x-d-card>
    </div>
</div>
@endsection
