<x-print-layout>
    <div class="w-[8.5in] p-2 bg-white">
        <div class="grid grid-cols-2">
            <div><span class="font-bold">Order No. :</span> {{\Str::padLeft($sale->id, 6, '0')}}</div>
            <div><span class="font-bold">Brand Model :</span> ____________________________</div>
            <div><span class="font-bold">Date :</span> {{$sale->date->format('m/d/Y')}}</div>
            <div><span class="font-bold">Plate No. :</span> ________________________________</div>
        </div>
        <table class="w-full border mt-2">
            <thead>
                <tr>
                    <th class="border p-1">Item/Labor</th>
                    <th class="border p-1">Qty</th>
                    <th class="border p-1">Unit</th>
                    <th class="border p-1">Amount</th>
                    <th class="border p-1">Sub-Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                <tr>
                    <td class="text-center border">
                        {{$item->salable->name}}
                    </td>
                    <td class="text-center border">
                        {{$item->salable_type == \App\Models\Product::class ?  $item->qty : ''}}
                    </td>
                    <td class="text-center border">
                        {{$item->salable_type == \App\Models\Product::class ?  ($item->qty > 1 ? 'PCS': 'PC') : ''}}
                    </td>
                    <td class="text-center border">
                        ₱ {{number_format($item->price, 2)}}
                    </td>
                    <td class="text-center border">
                        ₱ {{number_format($item->price * $item->qty, 2)}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-center font-bold border">
                        Total Amount
                    </td>
                    <td class="text-center text-green-600 font-bold">
                        ₱ {{number_format($sale->total_amount, 2)}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-print-layout>
