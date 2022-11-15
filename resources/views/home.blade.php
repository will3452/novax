@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center g-2">
       <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-header text-center">
                ORDERS
            </div>
            <div class="card-body text-center fs-2">
                {{\App\Models\Order::whereUserId(auth()->id())->count()}}
            </div>
        </div>
       </div>
       <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-header text-center">
                WISHLIST
            </div>
            <div class="card-body text-center fs-2">
                {{\App\Models\Wishlist::whereUserId(auth()->id())->count()}}
            </div>
        </div>
       </div>
       <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-header text-center">
                CART ITEMS
            </div>
            <div class="card-body text-center fs-2">
                {{\App\Models\Item::whereUserId(auth()->id())->whereNull('order_id')->count()}}
            </div>
        </div>
       </div>
    </div>
</div>
@endsection
