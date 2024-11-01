@props(['selectedYear', 'selectedMonth', 'withTithers' => false])

<x-finance-header :selected-year="$selectedYear"></x-finance-header>
<div class="mt-8 space-y-4">
    <x-heading>
        Monthly Report
    </x-heading>
    <table class="border w-full">
        <thead>
            <tr>
                <th class="border  text-sm  p-1">
                    Month
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
                <th class="border  text-sm  p-1">
                    Cash on hand / Bank
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
            @for ($i = 1; $i <= $selectedMonth; $i++)
            <tr>
                <td class="border p-1 text-sm">
                    {{\Carbon\Carbon::create(null, $i)->format('F')}}
                </td>
                @php
                    $tithes = \App\Models\Tithes::whereYear('date', $selectedYear)->whereMonth('date', $i)->sum('amount');
                    $offerings = \App\Models\Offering::whereYear('date', $selectedYear)->whereMonth('date', $i)->sum('amount');
                    $expenses = \App\Models\Expenses::whereYear('date', $selectedYear)->whereMonth('date', $i)->sum('amount');
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
                    {{number_format($expenses,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    {{number_format($tot,2)}}
                </td>
                <td class="border p-1 text-sm text-right">
                    {{$net < 0 ? '(': ''}} {{number_format(abs($net),2)}}{{$net < 0 ? ')': ''}}
                </td>
                <td class="border p-1 text-sm text-center ">
                    Cash On Hand
                </td>
            </tr>
            @endfor
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
    <x-page-break></x-page-break>
    <x-finance-header :selected-year="$selectedYear"></x-finance-header>
    <x-heading>
        Itemize Expenses
    </x-heading>
    <div class="grid grid-cols-2 gap-2">
        @for ($i = 1; $i <= $selectedMonth; $i++)
            <div>
                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="text-center  border p-1 text-gray-800">
                                {{\Carbon\Carbon::create(null, $i)->format('F')}}
                            </th>
                            <th class="text-center  border p-1 text-gray-800">
                                Expenses
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $items = \App\Models\Expenses::whereYear('date', $selectedYear)
                                ->whereMonth('date', $i)
                                ->groupBy('remarks')
                                ->select('remarks', \DB::raw('SUM(amount) as total'))
                                ->get();
                        @endphp
                        @forelse ($items as $item)
                            <tr>
                                <td class="text-center  border p-1 text-gray-800">
                                    {{$item->remarks}}
                                </td>
                                <td class="text-right border p-1 text-gray-800">
                                    {{number_format($item->total, 2)}}
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center p-1">
                                No Data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endfor
    </div>
    <x-page-break></x-page-break>
    @if ($withTithers)
    <x-finance-header :selected-year="$selectedYear"></x-finance-header>
    <x-heading>
        List of Tithers
    </x-heading>
    <table class="w-full border">
        <tr>
            <thead>
                <th class="border text-xs">
                    Names
                </th>
                @for ($i = 1; $i <= $selectedMonth; $i++)
                <th class="border text-xs">
                    {{\Carbon\Carbon::create(null, $i)->format('M')}}
                </th>
                @endfor
            </thead>
        </tr>
        <tbody>
            @php
            $year = $selectedYear;
                $members = \App\Models\Member::whereHas('tithes', function ($query) use ($year) {
                    $query->whereYear('date', $year);
                })->get();
            @endphp
            @foreach ($members as $member)
                <tr>
                    <td class="text-xs text-center border">
                        {{$member->name}}
                    </td>
                    @for ($i = 1; $i <= $selectedMonth; $i++)
                        <td class="border text-xs text-center">
                            @php
                                $t = \App\Models\Tithes::whereMemberId($member->id)->whereYear('date', $selectedYear)->whereMonth('date', $i)->sum('amount');
                            @endphp
                            {{$t ? number_format($t, 2): 'x'}}
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
