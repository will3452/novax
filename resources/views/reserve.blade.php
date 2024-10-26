@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Appointment Form
                </div>
                <div class="card-body">
                    <img src="/storage/{{$service->image}}" alt="" style="max-width:500px;display:block;margin:auto; ">
                    <br />
                    <br />
                    <h3 class="text-center">{{$service->name}}</h3>
                    <p class="text-center">
                        {{$service->description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
