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
                    <form action="/reserve" method="POST" class="text-left">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{auth()->id()}}">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="date"  min="{{date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Slot</label>
                            <select class="form-control" name="slot">
                                <option value="7:00:00-7:30:00">7:00:00-7:30:00</option>
                                <option value="8:00:00-8:30:00">8:00:00-8:30:00</option>
                                <option value="9:00:00-9:30:00">9:00:00-9:30:00</option>
                                <option value="10:00:00-10:30:00">10:00:00-10:30:00</option>
                            </select>
                        </div>
                        <input type="hidden" name="service" value="{{$service->name}}" />
                        <div class="form-group mt-4">
                            <label for="">Notes</label>
                            <textarea name="remarks" id="" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary mt-4">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
