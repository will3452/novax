<x-print-layout>
    <div class="text-center font-bold relative">
        <img class="w-[100px] h-[100px] ml-4 absolute top-2 " src="/storage/{{$branch->image}}" alt="">
        <div class="text-4xl bg-yellow-400 p-4">
            {{$branch->name}}
        </div>
        <div class="text-blue-600 bg-yellow-200 p-2">
            Payment Summary {{$date->format('M d, Y')}}
        </div>
    </div>
    <div class="flex justify-center mt-4">
        <div class="w-[400px] border">
            <div class="text-xl font-serif bg-blue-600 text-center font-bold">
                {{$payment_method}}
            </div>
            <table class="w-full border">
                <tr>
                    <th class="border">
                        No
                    </th>
                    <th class="border">
                        Customer
                    </th>
                    <th class="border">
                        Amount
                    </th>
                </tr>
                @php
                    $total = 0;
                @endphp
                @forelse ($transactions as $index => $t)
                    @php
                        $total += $t->total_amount;
                    @endphp
                    <tr>
                        <td class="border text-center">
                            {{$index + 1}}
                        </td>
                        <td class="text-center border">
                            {{$t->customer->name}}
                        </td>
                        <td class="text-right border px-1">
                            {{money($t->total_amount)}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="3" class="text-center">
                            No Data.
                        </th>
                    </tr>
                @endforelse
                <tr class="bg-red-500" >
                    <th colspan="2">
                        TOTAL
                    </th>
                    <th>
                        {{money($total)}}
                    </th>
                </tr>
            </table>
        </div>
    </div>
</x-print-layout>
