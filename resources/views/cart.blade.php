<x-layout>
    <x-navbar>
    </x-navbar>
    <h1 class="font-serif text-4xl mx-4 my-4 underline underline-offset-4 text-secondary">My Cart</h1>
    <div class="card m-4">
        <table class="table table-bordered table-sm">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>
                        {{$item->product->name}}
                    </td>
                    <td>
                        <input type="number" value="{{$item->quantity}}" class="input input-sm input-bordered">
                    </td>

                    <td>
                        {{number_format($item->product->price, 2)}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td class="font-bold">Sub Total</td>
                    <td class="text-xl">
                        {{number_format(auth()->user()->subTotal(), 2)}}
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
