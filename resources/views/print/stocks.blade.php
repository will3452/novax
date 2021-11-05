<x-print-layout title="STOCKS RECONCILIATION">
    <table class="w-full">
        <thead>
            <tr>
                <th class="border border-black">
                    Date
                </th>
                <th class="border border-black">
                    Item Name
                </th>
                <th class="border border-black">
                    Description
                </th>
                <th class="border border-black">
                    Location
                </th>
                <th class="border border-black">
                    Initial Number Of Stocks
                </th>
                <th class="border border-black">
                    Current Physical Count
                </th>
                <th class="border border-black">
                    Difference
                </th>
                <th class="border border-black">
                    Inventory Discrepancy
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td class="border border-black text-center">
                        {{$stock->created_at->format('m-d-y')}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->product->name}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->product->description}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->location}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->initial_number_of_stocks}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->current_physical_count}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->difference}}
                    </td>
                    <td class="border border-black text-center">
                        {{$stock->inventory_discrepancy}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print-layout>
