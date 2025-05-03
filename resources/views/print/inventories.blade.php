<x-print-layout>
    <div class="text-center font-bold relative">
        <img class="w-[100px] h-[100px] ml-4 absolute top-2 " src="/storage/{{$branch->image}}" alt="">
        <div class="text-4xl bg-yellow-400 p-4">
            {{$branch->name}}
        </div>
        <div class="text-blue-600 bg-yellow-200 p-2">
            Inventory As of {{now()->format('M d, Y')}}
        </div>
    </div>
    <table class="bg-white w-full border">
        <thead>
            <tr>
                <th class="border">SIZE</th>
                <th class="border">PRICE</th>
                <th class="border">COST</th>
                <th class="border">QTY ON HAND</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="{{$item->qty <= 0 ? '': 'bg-red-100'}}">
                    <td class="border px-2">
                        {{ $item->product_name }}
                    </td>
                    <td class="border px-2">
                        {{ money($item->product?->price, 2) }}
                    </td>
                    <td class="border px-2">
                        {{ money($item->product?->cost, 2) }}
                    </td>
                    <td class="border px-2">
                        {{ $item->qty }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print-layout>
