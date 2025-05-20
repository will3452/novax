<x-print-layout>
    <div class="text-center font-bold relative">
        <img class="w-[100px] h-[100px] ml-4 absolute top-2 " src="/storage/{{$branch->image}}" alt="">
        <div class="text-4xl bg-yellow-400 p-4">
            {{$branch->name}}
        </div>
        <div class="text-blue-600 bg-yellow-200 p-2">
            {{\Carbon\Carbon::parse($from)->format('M d')}} - {{\Carbon\Carbon::parse($to)->format('M d, Y')}}
        </div>
    </div>
    <table class="bg-white w-full border">
        <thead>
            <tr>
                <th class="border">DATE</th>
                <th class="border">SALES</th>
                <th class="border">COST</th>
                <th class="border">NET INCOME</th>
                <th class="border">LABOR</th>
                <th class="border">EXPENSES</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSales = 0;
                $totalCost = 0;
                $totalNet = 0;
                $totalLabor = 0;
                $totalExpenses = 0;
            @endphp
            @foreach ($dates as $date)
                <tr>
                    <td class="border text-center">
                        {{\Carbon\Carbon::parse($date)->format('m/d/Y')}}
                    </td>
                    <td class="border text-right px-2">
                        @php
                            $sales = \App\Models\Sale::whereBranchId($branch->id)->whereDate('date', $date)->whereType('SALES')->sum('total_amount');
                            $totalSales += $sales;
                            $labor = \App\Models\Sale::whereBranchId($branch->id)->whereDate('date', $date)->whereType('SERVICE')->sum('total_amount');
                            if ($labor) $totalLabor += ($labor / 2);
                            $costs = \App\Models\Sale::whereBranchId($branch->id)->whereDate('date', $date)->whereType('SALES')->sum('total_cost');
                            $totalCost += $costs;
                            $expenses = \App\Models\Expenses::whereBranchId($branch->id)->whereDate('created_at', $date)->sum('amount');
                            $totalExpenses += $expenses;
                            $totalNet += ($sales - $costs);
                        @endphp
                        {{$sales == 0 ?'---' : money($sales)}}
                    </td>
                    <td class="border text-right px-2">
                        {{$costs == 0 ? '---': money($costs)}}
                    </td>
                    <td class="border text-right px-2">
                        {{$sales == 0 ? '---': money($sales - $costs)}}
                    </td>
                    <td class="border text-right px-2">
                        {{$labor == 0 ? '---': money($labor / 2)}}
                    </td>
                    <td class="text-right px-2 border">
                        {{$expenses == 0 ? '---': money($expenses)}}
                    </td>
                </tr>
            @endforeach
            <tr>
                <th class="border">TOTAL</th>
                <th class="text-right px-2 border">
                    {{money($totalSales)}}
                </th>
                <th class="text-right px-2 border">
                    {{money($totalCost)}}
                </th>
                <th class="text-right px-2 border">
                    {{money($totalNet)}}
                </th>
                <th class="text-right px-2 border">
                    {{money($totalLabor)}}
                </th>
                <th class="text-right px-2 border">
                    {{money($totalExpenses)}}
                </th>
            </tr>
        </tbody>
    </table>
    <table class="mt-4 border bg-white w-[350px]">
        <tr>
            <th class="border">
                TOTAL COST
            </th>
            <td class="border text-right px-2">
                {{money($totalCost)}}
            </td>

        </tr>
        <tr>
            <th class="border">
                EXPECTED MARK-UP
            </th>
            <td class="border text-right px-2">
                20%
            </td>
        </tr>
        <tr>
            <th class="border">
                EXPECTED INCOME
            </th>
            <td class="border text-right px-2">
                {{money($totalCost * .2)}}
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center">VS</td>
        </tr>
        <tr>
            <th class="border">
                ACTUAL INCOME
            </th>
            <td class="border text-right px-2">
                {{money($totalNet)}}
            </td>

        </tr>
        <tr>
            <th class="border">
                ACTUAL MARK-UP
            </th>
            <td class="border text-right px-2">
                {{$totalNet > 0 ?  number_format(($totalNet / $totalCost) * 100, 1): '--'}}%
            </td>

        </tr>
    </table>
</x-print-layout>
