@if (request()->prof_ratio == 'return_on_equity')
    <div class="border-2  p-2 rounded">
        <table class="text-xl w-full">
            <tr>
                <td rowspan="2">
                    Return on Equity ({{\Carbon\Carbon::parse(\App\Accounting::getAccountingPeriod()->end)->format('Y/m/d')}})
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td class="border-b-2 border-black">
                    {{number_format(abs(\App\Accounting::getNetIncome()), 2)}}
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td rowspan="2">
                    <span class="p-2 bg-yellow-200 mx-2 rounded">
                        {{number_format(\App\Accounting::getReturnOnEquity(), 2)}} %
                    </span>

                </td>
            </tr>
            <tr>
                <td >
                    {{number_format(abs(\App\Accounting::getCapitalTotal()), 2)}}
                </td>
            </tr>
        </table>
    </div>
@endif
