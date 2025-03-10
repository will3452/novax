@props(['branch', 'date'])
<div class="w-[14in] bg-white border-2">
    <div class="font-serif grid grid-cols-[1fr_3fr_1fr] bg-[#a8d0a8] py-4">
        <div>
            <img src="" alt="">
        </div>
        <div class="text-center font-bold">
            <div>
                {{$branch->address}}
            </div>
            <div class="text-blue-600">
                Email Add: carkeanjantiresupply.store@gmail.com
            </div>
        </div>
    </div>
    <div class="text-center font-serif">
        <div class="font-bold text-red-600 text-xl">
            DAILY SALES REPORTING
        </div>
    </div>
    <div class="text-center font-bold font-serif bg-[#a8d0a8]">
        {{newDate($date)->format('F d, Y')}}
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-[#c55a11]">
                <th class="border">
                    NO.
                </th>
                <th class="border">
                    BRAND
                </th>
                <th class="border">
                    SIZE
                </th>
                <th class="border">
                    QTY
                </th>
                <th class="border">
                    COST PER TIRE
                </th>
                <th class="border">
                    TOTAL COST
                </th>
                <th class="border">
                    SALES TIRES
                </th>
                <th class="border">
                    NET TIRE INCOME
                </th>
                <th class="border">
                    LUBES
                </th>
                <th class="border">
                    OTHERS
                </th>
                @foreach (\App\Models\Service::get() as $service)
                    <th class="border text-center uppercase">
                        {{$service->name}}
                    </th>
                @endforeach
                <th class="border">
                    EXPENSES
                </th>
                <th class="border">
                    SALES W/ LESS EXP.
                </th>
                <th class="border">
                    NET INCOME
                </th>
            </tr>
        </thead>
        <tbody class="border">
            @php
                $id = 1;
                $records = \App\Models\Sale::whereBranchId($branch->id)
                    ->whereDate('date', $date)
                    ->whereStatus('CONFIRMED')->get();
                $row = 0;
                $iteration = 0;
                $totalCost = getTotalSalesCostOfBranch($branch->id, $date);
                $totalSales = 0;
                $totalNetTireIncome = 0;
                $totalLubes = 0;
                $totalLubes = 0;
                $totalOthers = 0;
                $totalFinalSales = 0;
                $totalExpenses = getDailyExpensesOfBranch($branch->id, $date);
                $totalServiceCommission = [];
                $salesWithLessExpenses = getSalesWithLessExpensesOfBranch($branch->id, $date);
                foreach ($records as $record) {
                    $row += count($record->items);
                }
            @endphp
            @foreach ($records as $key => $item)
                @foreach ($item->items as $i)
                    <tr>
                        <td class="border text-center">
                            {{-- {{$id}} --}}
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? $i->salable->brand->name : ''}}
                        </td>
                        <td class="border">
                            {{isTire($i) ? $i->salable->name : ''}}
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? $i->qty : ''}}
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? money($i->salable->cost): ''}}
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? money($i->salable->cost * $i->qty): ''}}
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? money($i->price  * $i->qty): ''}}
                            @php
                                if (isTire($i)) {
                                    $totalSales += $i->price  * $i->qty;
                                    $totalFinalSales += $i->price  * $i->qty;
                                }
                            @endphp
                        </td>
                        <td class="border text-center">
                            {{isTire($i) ? money(($i->price  * $i->qty) - ($i->salable->cost * $i->qty)): ''}}
                            @php
                                if (isTire($i))  $totalNetTireIncome += ($i->price  * $i->qty) - ($i->salable->cost * $i->qty);
                            @endphp
                        </td>
                        <td class="border text-center">
                            {{ isLubes($i) ? money(($i->price  * $i->qty)): ''}}
                            @php
                                if (isLubes($i)){
                                    $totalLubes += ($i->price  * $i->qty);
                                    $totalFinalSales += ($i->price  * $i->qty);
                                }
                            @endphp
                        </td>
                        <td class="border text-center">
                            {{ isOthers($i) ? money(($i->price  * $i->qty)): ''}}
                            @php
                                if (isOthers($i)) {
                                    $totalFinalSales += ($i->price  * $i->qty);
                                    $totalOthers += ($i->price  * $i->qty);
                                }
                            @endphp
                        </td>
                        @foreach (\App\Models\Service::get() as $service)
                            <td class="border text-center">
                                {{isService($i) && $service->id == $i->salable_id ? money((($i->price * $i->qty))) : ''}}
                                @php
                                    if (isService($i)) {
                                        if (! array_key_exists($service->id, $totalServiceCommission)) {
                                            $totalServiceCommission[$service->id] = 0;
                                        }
                                        if ($service->id == $i->salable_id ) {
                                            $totalServiceCommission[$service->id] += (($i->price * $i->qty) );
                                            $totalFinalSales += ($i->price * $i->qty);
                                        }
                                    }

                                @endphp
                            </td>
                        @endforeach
                        <td class="border-r text-center">{{intval($row / 2) == $id ? money($totalExpenses): ''}}</td>
                        <td class="border-r text-center">{{intval($row / 2) == $id ? money($salesWithLessExpenses): ''}}</td>
                        <td class="border-r text-center">{{intval($row / 2) == $id ? money($salesWithLessExpenses - $totalCost): ''}}</td>
                    </tr>
                    @php
                        $id++;
                    @endphp
                @endforeach
            @endforeach
            <tr>
                <td class="bg-[#c55a11]"></td>
                <td class="bg-[#c55a11]"></td>
                <td class="bg-[#c55a11]"></td>
                <td class="bg-[#c55a11]"></td>
                <td class="bg-[#c55a11]"></td>
                <td class="border text-center border-l-0 bg-[#c55a11]">
                    {{money($totalCost)}}
                </td>
                <td class="border text-center  bg-[#ffd965]">
                    {{money($totalSales)}}
                </td>
                <td  class="border text-center">
                    {{money($totalNetTireIncome)}}
                </td>
                <td  class="border text-center bg-[#ffd965]">
                    {{money($totalLubes)}}
                </td>
                <td class="border text-center bg-[#ffd965]">
                    {{money($totalOthers)}}
                </td>
                @foreach (\App\Models\Service::get() as $service)
                        <td class="border text-center bg-[#ffd965]">
                            {{money($totalServiceCommission[$service->id])}}
                        </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
