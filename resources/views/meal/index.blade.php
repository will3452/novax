@extends('layouts.app')
@section('content')
    <h1 class="text-center">Recommended food for you.</h1>
    <div class="container">
        <div class="alert alert-warning">
            Remiders! if your allergy/allergies is still there in the given meal below, please press the button <strong>OTHER MEAL</strong> at the bottom of the page, to generate new meal.
        </div>
    </div>
    <div class="container mt-5">
        @foreach (['breakfast', 'lunch', 'supper', 'dinner'] as $type)
        <div class="mt-4">
            <h3>{{\Str::title($type)}}</h3>
            @if ($today[$type.'_id'])
            <div class="row">
                @php
                    $meal = \App\Models\Meal::find($today[$type.'_id']);
                    if (!$meal) {
                        echo '<div class="alert alert-secondary">no data found.</div>';
                        continue;
                    }
                @endphp
                <div class="col-md-4">
                    <img src="/storage/{{$meal->image}}" alt="" style="width:300px !important;height:300px !important; object-fit:cover;">
                </div>
                <div class="col-md-8">
                    @foreach (['nutrition', 'foods', 'allergen information'] as $item)
                    <h5>{{\Str::plural(\Str::title($item))}}</h5>
                    <ul>
                        @foreach (explode('--', $meal[implode('_', explode(' ',$item))]) as $xitem)
                            <li>{{$xitem}}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>
            @else
            <div class="alert alert-info">
                Nothing was found in the system for your {{$type}} today.
            </div>
            @endif
        </div>
        @endforeach
        @if ($today->breakfast_id == null && $today->lunch_id == null && $today->supper_id == null && $today->dinner_id == null)
        @else
        <form action="{{route('progress')}}" class="mt-5" method="POST">
            @csrf
            <input type="hidden" value="MealToday" name="type">
            <input type="hidden" value="{{$today->id}}" name="id">
            <input type="hidden" name="alert" value="Record has been recorded to your progress">
            <button class="btn btn-primary">
                TAKE MEAL
            </button>
            <a class="btn btn-success" href="/generate-meal">
                OTHER MEAL
            </a>
        </form>
        @endif
    </div>
@endsection
