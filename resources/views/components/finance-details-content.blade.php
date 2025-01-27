@props(['selectedYear', 'selectedMonth', 'withTithers' => false])

<x-finance-details-header :selected-year="$selectedYear"/>
@php
    $sundays = [];
    $startOfMonth = \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1);

    // Find the first Sunday of the month
    if (!$startOfMonth->isSunday()) {
        $startOfMonth->next(\Carbon\Carbon::SUNDAY);
    }

    // Loop through each Sunday until the end of the month
    while ($startOfMonth->month == $selectedMonth) {
        $sundays[] = $startOfMonth->format('Y-m-d');
        $startOfMonth->addWeek(); // Move to the next Sunday
    }
@endphp
<div class="mt-8 space-y-4">
    <table class="border w-full">
        <thead>
            <tr>
                <th class="border  text-sm  p-1">
                    Week
                </th>
                <th class="border  text-sm  p-1">
                    Tithes
                </th>
                <th class="border  text-sm  p-1">
                    Offering
                </th>
                <th class="border  text-sm  p-1">
                    Gross
                </th>
                <th class="border  text-sm  p-1">
                    Expenses
                </th>
                <th class="border  text-sm  p-1">
                    Tithes of Tithes
                </th>
                <th class="border  text-sm  p-1">
                    Net
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalExpenses = 0;
                $totalTithes = 0;
                $totalOfferings = 0;
                $totalGross = 0;
                $totalTot = 0;
                $totalNet = 0;
            @endphp
            @foreach ($sundays as $i => $week)
            <tr>
                <td class="border p-1 text-sm text-center">
                    {{$i + 1}}
                </td>
                @php
                    $weekDate = \Carbon\Carbon::parse($week);
                    $tithes = \App\Models\Tithes::whereDate('date',$weekDate)->sum('amount');
                    $offerings = \App\Models\Offering::whereDate('date', $weekDate)->sum('amount');
                    $expenses = \App\Models\Expenses::whereDate('date', $weekDate)->sum('amount');
                    $expensesItem = \App\Models\Expenses::whereDate('date', $weekDate)->get();
                    $totalExpenses += $expenses;
                    $totalOfferings += $offerings;
                    $totalTithes += $tithes;
                    $tot = ($tithes + $offerings) * .10;
                    $totalTot += $tot;
                    $gross = $offerings + $tithes;
                    $totalGross += $gross;
                    $net = $gross - ($tot + $expenses);
                    $totalNet += $net;
                @endphp
                <td class="border p-1 text-sm text-right">
                    {{number_format($tithes,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    {{number_format($offerings,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    {{number_format($gross,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    <ul>
                        @foreach ($expensesItem as $item)
                            <li>{{number_format($item->amount, 2)}} - {{$item->remarks}}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="border p-1 text-sm text-right">
                    {{number_format($tot,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    {{$net < 0 ? '(': ''}} {{number_format(abs($net),2)}}{{$net < 0 ? ')': ''}}
                </td>
            </tr>
            @endforeach
            <tr>
                <th class="border p-1 text-center text-xs">Total</th>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalTithes,2)}}
                </td>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalOfferings,2)}}
                </td>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalGross,2)}}
                </td>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalExpenses,2)}}
                </td>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalTot,2)}}
                </td>
                <td class="border p-1 text-right text-xs">
                    {{number_format($totalNet,2)}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
