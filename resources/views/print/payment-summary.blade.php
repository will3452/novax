<x-print-layout>
    <div class="text-center font-bold relative">
        <img class="w-[100px] h-[100px] ml-4 absolute top-2 " src="/storage/{{$branch->image}}" alt="">
        <div class="text-4xl bg-yellow-400 p-4">
            {{$branch->name}}
        </div>
        <div class="text-blue-600 bg-yellow-200 p-2">
            Payment Summary ({{$from->format('M d')}} {{$to->format('M d, Y')}})
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-2 px-2">
        @foreach ($paymentMethods as $paymentMethod)
            <div>
                <div class="bg-blue-600 text-xl text-center font-serif font-bold">
                    {{$paymentMethod->name}}
                </div>
                <table class="w-full border">
                    <tr>
                        <th class="border">NO</th>
                        <th class="border">DATE</th>
                        <th class="border">AMOUNT</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($period as $key => $date)
                        <tr>
                            <td class="border text-center">
                                {{$key + 1}}
                            </td>
                            <td class="border text-center">
                                {{$date->format('m/d/y')}}
                            </td>
                            <td class="border text-right px-2">
                                @php
                                    $date_sale = \App\Models\Sale::wherePaymentMethod($paymentMethod->name)->whereBranchId($branch->id)->whereDate('date', $date)->sum('total_amount');
                                    $total += $date_sale;
                                @endphp
                                {{
                                    $date_sale ? money($date_sale): '---'
                                }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-red-400 border">
                        <th colspan="2" >
                            OVERALL AMOUNT
                        </th>
                        <th>
                            {{money($total)}}
                        </th>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</x-print-layout>
