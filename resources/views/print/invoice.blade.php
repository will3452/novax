<x-print-layout>
    <div class="w-[210mm] border print:border-none p-4 print:p-4 space-y-4 bg-white">
    {{-- <div class="w-[210mm] h-[297mm] border p-2 space-y-4"> --}}
        <div class="flex items-center justify-between">
            {{-- <img src="/storage/{{$invoice->branch->image}}" class="w-[75px] h-[75px] rounded-full" alt="" /> --}}
            <div>
                <div class="text-lg font-bold">{{$invoice->branch_name}}</div>
                <div>{{$invoice->branch_address ?? '---'}}</div>
            </div>
            <div class="font-bold text-lg ">
                <div class="text-center uppercase">{{$invoice->type ?? 'Sales'}}</div>
                <div class="text-center ">INVOICE</div>
                <div class="text-red text-red-600 text-2xl text-center">
                    NO. {{$invoice->invoice_number}}
                </div>
            </div>
        </div>
        <table class="w-full">
            <tr>
                <td>
                    <input type="checkbox" />
                    CASH SALES
                </td>
                <td>
                    <input type="checkbox" />
                    CHARGE SALES
                </td>
                <td></td>
                <td class="border text-center ">Date: </td>
                <td colspan="2" class="border text-center">{{$invoice->created_at->format('m/d/Y')}}</td>
            </tr>
            <tr>
                <td colspan="6" class="border p-1">SOLD TO: </td>
            </tr>
        </table>
        <div class="space-y-1">
            <table class="w-full border">
                <tr>
                    <td class="p-1">Registered Name: </td>
                    <td colspan="5" >{{$invoice->customer_name}}</td>
                </tr>
                <tr>
                    <td class="p-1">TIN: </td>
                    <td colspan="5" >{{$invoice->customer_tin}}</td>
                </tr>
                <tr>
                    <td class="p-1">Business Address: </td>
                    <td colspan="5" >{{$invoice->customer_address}}</td>
                </tr>
            </table>
            <table class="border w-full">
                <tr>
                    <th class="p-1">Description</th>
                    <th class="p-1">Quantity</th>
                    <th class="p-1">Unit Price</th>
                    <th class="p-1">Amount</th>
                </tr>
                @foreach ($invoice->items as $item)
                    <tr>
                        <td class="border text-center p-1">
                            {{$item['description']}}
                        </td>
                        <td class="border text-center p-1">
                            {{$item['qty']}}
                        </td>
                        <td class="border text-center p-1">
                            ₱ {{number_format($item['unit_price'], 2)}}
                        </td>
                        <td class="border text-center p-1">
                            ₱ {{number_format($item['amount'], 2)}}
                        </td>
                    </tr>
                @endforeach
                @for ($i = 0; $i < (9 - count($invoice->items)); $i++)
                    <tr>
                        <td class="border border-black text-center p-1 text-white">
                            --
                        </td>
                        <td class="border border-black text-center p-1 text-white">
                            --
                        </td>
                        <td class="border border-black text-center p-1 text-white">
                            --
                        </td>
                        <td class="border border-black text-center p-1 text-white">
                            --
                        </td>
                    </tr>
                @endfor
            </table>
            <div class="grid grid-cols-[5fr_1fr_5fr] items-start">
                <div class="space-y-4">
                    <table class="w-full">
                        <tr>
                            <td class="border p-1" colspan="2">
                                SC/PWD/NAAC/MOV/Solo SP
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                <span class="text-xs relative -top-2">ID No.</span>
                            </td>
                            <td class="border p-1">
                                <span class="text-xs relative -top-2">Signature</span>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center space-y-4">
                        <div>
                            <input type="checkbox" /> Received the amount of
                        </div>
                        <div class="border-b-2"></div>
                    </div>
                </div>
                <div></div>
                <table>
                    <tr>
                        <td class="border p-1">Total Sales</td>
                        <td class="border p-1 ">₱ {{number_format($invoice->total_sales, 2)}}</td>
                    </tr>
                    <tr>
                        <td class="border text-xs p-1">
                            <div>
                                Less: Discount
                            </div>
                            <div class="text-[8px]">
                                [SC/PWD/NAAC/MOV/Solo SP]
                            </div>
                        </td >
                        <td class="p-1 border"></td>
                    </tr>
                    <tr>
                        <td class="border p-1 text-xs">Less Withholding Tax</td>
                        <td class="border p-1 "></td>
                    </tr>
                    <tr>
                        <td class="border p-1 text-xs">Total Amount Due</td>
                        <td class="border p-1 ">₱ {{number_format($invoice->total_amount_due, 2)}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="grid grid-cols-2 text-center">
            <div class="font-bold px-8">
                "THIS DOCUMENT IS NOT VALID FOR CLAIM OF INPUT TAX"
            </div>
            <div>
                <div class="border-b-2">
                    {{$invoice->cashier}}
                </div>
                <div>Cashier / Authorized Representative</div>
            </div>
        </div>
        <div></div>
    </div>
</x-print-layout>
