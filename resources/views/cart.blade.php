@extends('layouts.app')

@section('content')
    <div class="row container py-2 mx-auto g-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    My Cart
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse (auth()->user()->items()->whereNull('order_id')->get() as $item)
                            <li class="list-group-item">
                                <div class="d-flex  justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <img src="/storage/{{$item->product->image}}" alt="" class="img-fluid rounded-circle" style="width: 40px; height: 40px; object-fit:cover;">
                                        <div class="mx-2">
                                            <div class="text-secondary">
                                                {{$item->product->name}}
                                            </div>
                                            <div class="fw-bolder fs-6">
                                                PHP {{$item->product->price}} x {{$item->quantity}}
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('products.remove-to-cart', ['product' => $item->product->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            remove
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item bg-secondary text-white text-center">
                                No item found.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Proceed to order
                </div>
                <div class="card-body">
                    @if (! session()->get('discount'))
                        <form class="d-flex mb-4" action="{{route('products.discount')}}" method="POST">
                            @csrf
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="Enter discount code"> <button class="btn btn-primary btn-sm mx-2">Apply</button>
                        </form>
                    @else
                    <div class="alert alert-success">
                        <span class="fw-bolder">{{session()->get('discount')->code}}</span> has been applied, You've {{session()->get('discount')->rate}}% off !
                    </div>
                    @endif
                    <div>
                        Sub-Total: PHP
                        <span class="fs-6">
                             {{number_format(auth()->user()->total_items_amount, 2)}}
                        </span>
                    </div>
                    <div>
                        Delivery Fee: PHP
                        <span class="fs-6">
                            {{auth()->user()->shipping_fee}}
                            {{-- TODO add dynamic deliv fee --}}
                        </span>
                    </div>
                    <div>
                        Total Payable: PHP
                        <span class="fs-4 {{session()->has('discount') ? ' text-secondary text-decoration-line-through': ''}}" >
                            {{number_format(auth()->user()->total_amount_payable, 2)}}
                        </span>
                        @if (session()->has('discount'))
                             <span class="fs-4">{{number_format(auth()->user()->discountedTotalAmount(session()->get('discount')->rate), 2)}}</span>
                        @endif
                    </div>
                    <form action="{{route('orders.store')}}" method="POST">
                        @csrf
                        <div class="my-3">
                            <div>
                                Select mode of payment
                            </div>
                            <select name="mop" id="" class="form-select form-select-sm">
                                <option value="GCASH">GCASH</option>
                                <option value="COD">Cash On Delivery</option>
                            </select>
                        </div>
                        <input type="hidden" name="discount_id" value="{{session()->has('discount') ? session()->get('discount')->id : ''}}">
                        @if (auth()->user()->hasItem())
                            <button class="btn w-100 btn-success">
                                Proceed
                            </button>
                        @else
                        <button type="button"  disabled class="btn w-100 btn-success">
                            Proceed
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
