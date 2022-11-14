@extends('layouts.app')

@section('content')
    <div class="m-auto text-center mt-5" style="max-width: 400px;">
        <img src="/storage/{{$product->image}}" alt="" class="img-fluid">
        <div class="my-4">
            <h4>
                {{$product->name}}
            </h4>
            <h5 class="fw-bold">
                PHP {{number_format($product->price, 2)}}
            </h5>
        </div>
        <p>
            {{$product->description}}
        </p>

    </div>
    <form action="{{route('products.to-cart', ['product' => $product->id])}}" method="POST" class="sticky-bottom bg-white p-4 w-full text-center d-flex items-center justify-content-center">
        @csrf
        <input type="number" name="quantity" placeholder="Quantity" class="border p-1 rounded mx-1" min="1" style="max-width: 100px;">
            <button class="btn btn-sm btn-success mx-1">
                Add to cart
            </button>
        {{-- <button class="btn btn-sm btn-secondary mx-1">
            Add to wishlist
        </button> --}}
    </form>
@endsection
