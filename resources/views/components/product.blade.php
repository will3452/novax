@props(['product'])
<div class="shadow p-2 w-44 rounded m-4">
    <div class="flex justify-center mb-4">
        <img src="{{$product->image != 0 ? $product->image : 'https://via.placeholder.com/150?text=No+image'}}" alt="" class="h-32 w-32 border">
    </div>
    <div class="text-center">
        <h3 class="font-bold text-center uppercase text-xs">{{$product->name}}</h3>
        <h3 class="font-bold text-center text-xl">₱ {{number_format($product->price, 2)}}</h3>
        @auth
            @if (! auth()->user()->isInTheCart($product->id))
                <label  for="product-{{$product->id}}" class="modal-button btn btn-xs btn-primary my-2">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4Zm-8 2a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z"/></svg>
                    add to cart
                </label >
            @else
                <form action="/remove-to-cart/{{$product->id}}" method="POST">
                    @csrf
                    <button  class="modal-button btn btn-xs btn-warning my-2">
                        <svg width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 0 0 1.414.586H19a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-8.172a2 2 0 0 0-1.414.586L3 12Z"/></svg>
                        remove to cart
                    </button >
                </form>
            @endif
        @else
                <a href="/app/login" class="modal-button btn btn-xs btn-primary my-2" >
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4Zm-8 2a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z"/></svg>
                    add to cart
                </a>
        @endauth
        <input type="checkbox" id="product-{{$product->id}}" class="modal-toggle" />
        <div class="modal">
        <div class="modal-box w-11/12 max-w-5xl text-left">
            <label for="product-{{$product->id}}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <div class="flex items-end">
                <div class="w-5/12 bg-red-400">
                    <img class="w-full" src="{{$product->image != 0 ? $product->image : 'https://via.placeholder.com/150?text=No+image'}}" alt="">
                </div>
                <div class="w-7/12 px-4" x-data="{price: {{$product->price}}, qty: 1}" >
                    <h2 class="text-2xl">{{$product->name}}</h2>
                    <h3 class="font-bold">
                        ₱ <span x-text="(price* qty).toFixed(2)"></span>
                    </h3>
                    <p class="text-secondary text-sm font-serif">{{$product->description}}</p>
                    <form action="/add-to-cart/{{$product->id}}" method="POST" class="flex items-center">
                        @csrf
                        <input type="number" x-model="qty" value="1" name="quantity" min="1" class="input input-bordered mr-4" placeholder="Quatity" >
                        <button class="btn btn-primary my-4">
                            <svg width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4Zm-8 2a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z"/></svg>
                            ADD TO CART
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
