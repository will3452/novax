@if (request()->liquidity_ratio == 'cash_ratio')
    <div class="border-2  p-2 rounded">
        <table class="text-xl w-full">
            <tr>
                <td rowspan="2">
                    Cash Ratio ({{\Carbon\Carbon::parse(\App\Accounting::getAccountingPeriod()->end)->format('Y/m/d')}})
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td class="border-b-2 border-black">
                    {{abs(\App\Accounting::getCashTotal())}}
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td rowspan="2">
                    <span class="p-2 bg-yellow-200 mx-2 rounded">
                        {{number_format(abs(\App\Accounting::getCashRatio()), 2)}}
                    </span>

                </td>
            </tr>
            <tr>
                <td >
                    {{abs(\App\Accounting::getTotal(\App\Accounting::getCurrentLiabilities()))}}
                </td>
            </tr>
        </table>
    </div>
@endif
