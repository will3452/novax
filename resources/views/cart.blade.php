<x-layout>
    <x-navbar>
    </x-navbar>
    <h1 class="font-serif text-4xl mx-4 my-4 underline underline-offset-4 text-secondary">My Cart</h1>
    <div class="card m-4">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Price
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr x-data="{price: {{$item->product->price}}, qty: {{$item->quantity}}, dirty () {
                    return this.qty != {{$item->quantity}}
                }}">
                    <td>
                        {{$item->product->name}}
                    </td>
                    <td>
                        <input type="number" min="1" x-model="qty" class="input input-sm input-bordered">
                    </td>

                    <td x-text="(price * qty).toFixed(2)">

                    </td>
                    <td class="flex">
                        <form class="mx-2" method="POST" action="/update-cart/{{$item->id}}" x-show="dirty">
                            @csrf
                            @method('PUT')
                            <input type="hidden" x-model="qty" name="quantity">
                            <button class="btn btn-sm btn-secondary">
                                save
                            </button>
                        </form>
                        <form method="POST" action="/remove-to-cart/{{$item->product_id}}">
                            @csrf
                            <button class="btn btn-accent btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="bg-gray-200"></td>
                    <td class="bg-gray-200">Sub Total</td>
                    <td class="bg-gray-200">  {{number_format((auth()->user()->subTotal()), 2)}} </td>
                    <td class="bg-gray-200"></td>
                </tr>
                <tr>
                    <td class="bg-gray-200"></td>
                    <td class="bg-gray-200">VAT (12 %) </td>
                    <td class="bg-gray-200">  {{number_format((auth()->user()->subTotal() * .12), 2)}} </td>
                    <td class="bg-gray-200"></td>
                </tr>
                <tr class="text-xl">
                    <td class="bg-gray-200"></td>
                    <td class="font-bold bg-gray-200">Total</td>
                    <td class="bg-gray-200">
                        ₱ {{number_format(auth()->user()->subTotal() + (auth()->user()->subTotal() * .12), 2)}}
                    </td>
                    <td class="bg-gray-200" >
                       @if (auth()->user()->cartItems()->count())

                       <form action="/checkout" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-lg flex">
                                Pay now
                                <img class="w-24 mx-2" src="https://getpaid.gcash.com/assets/img/logo@3x.png" alt="">
                            </button>
                        </form>
                       @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
