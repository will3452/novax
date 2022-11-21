@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">Foods</li>
</ol>

<form class="row mb-2" action="/foods" method="get">
    <div class="col-md-3 d-flex">
        <select name="type" id="" class="form-select form-select-sm mx-2">
            <option value="" {{request()->type == '' ? 'selected': ''}}>
                All
            </option>
            <option value="Breakfast" {{request()->type == 'Breakfast' ? 'selected': ''}}>
                Breakfast
            </option>
            <option value="Lunch" {{request()->type == 'Lunch' ? 'selected': ''}}>
                Lunch
            </option>
            <option value="Dinner" {{request()->type == 'Dinner' ? 'selected': ''}}>
                Dinner
            </option>
        </select>
        <button class="btn btn-primary btn-sm">
            Apply
        </button>
    </div>
</form>

<div class="row g-2" data-masonry='{"percentPosition": true }'>
    @foreach ($foods as $food)
        <div class="col-md-2 col-6">
            <div class="card">
                <img src="/storage/{{$food->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="fs-6 fw-bold text-uppercase text-center">
                        {{$food->name}}
                    </div>
                    <div class="text-center">
                        <a href="?type={{$food->type}}" class="fs-6">
                            {{$food->type}}
                        </a>
                    </div>
                    <form class="card-action text-center" method="POST" action="{{route('activities.add')}}">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{$food->id}}" class="btn btn-primary btn-sm">
                            VIEW
                        </a>
                        @csrf
                        <input type="hidden" name="meal_id" value="{{$food->id}}">
                        @if ($food->taken)
                        <button class="btn btn-success btn-sm" disabled>TAKE</button>
                        @else
                            <button class="btn btn-success btn-sm">TAKE</button>
                        @endif
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{$food->id}}" tabindex="-1" aria-labelledby="modal-{{$food->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 text-uppercase" id="exampleModalLabel">{{$food->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <img src="/storage/{{$food->image}}"  class="img-fluid" alt="">
                                </div>
                                <div class="mb-2">
                                    <div class="fs-3">
                                        Benefits
                                    </div>
                                    <div>
                                        {{$food->benefits}}
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="fs-3">
                                        Instructions
                                    </div>
                                    <div>
                                        {{$food->instruction}}
                                    </div>
                                </div>
                            </div>
                            <form class="modal-footer" method="POST" action="{{route('activities.add')}}">
                                @csrf
                                <input type="hidden" name="meal_id" value="{{$food->id}}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @if ($food->taken)
                                <button class="btn btn-success" disabled>TAKE</button>
                                @else
                                    <button class="btn btn-success">TAKE</button>
                                @endif

                            </form>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>

@push('body')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
@endpush

@endsection
