@extends('layouts.app')

@section('content')
@push('head-script')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" defer></script>
@endpush
    <div class="row mx-2"  data-masonry='{"percentPosition": true }'>
        @foreach (\App\Models\Product::get() as $product)
            <div class="col-md-2 g-2 col-6">
                <div class="card card-sm">
                    <img src="/storage/{{$product->image}}" class="card-img-top" alt="{{$product->name}} image">
                    <div class="card-body p-2">
                        <p class="card-text">
                            <div class="text-center">
                                {{$product->name}}
                            </div>
                            <div class="text-center fw-bold">
                                PHP {{$product->price}}
                            </div>
                            <div class="text-center ">
                                <a class="btn btn-outline-primary btn-sm" style="text-decoration:none;" href="{{route('products.show', ['product' => $product ])}}">
                                    view details
                                </a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
