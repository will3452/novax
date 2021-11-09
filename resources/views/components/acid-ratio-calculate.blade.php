@if (request()->liquidity_ratio == 'acid_ratio')
    <div class="border-2  p-2 rounded">
        <table class="text-xl w-full">
            <tr>
                <td rowspan="2">
                    Acid Test Ratio ({{\Carbon\Carbon::parse(\App\Accounting::getEndDate())->format('Y/m/d')}})
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td class="border-b-2 border-black">
                    {{\App\Accounting::getQuickAssets()}}
                </td>
                <td rowspan="2" class="px-2">
                    =
                </td>
                <td rowspan="2">
                    <span class="p-2 bg-yellow-200 mx-2 rounded">
                        {{number_format(\App\Accounting::getAcidRatio(), 2)}}
                    </span>

                </td>
            </tr>
            <tr>
                <td >
                    {{\App\Accounting::getTotal(\App\Accounting::getCurrentLiabilities())}}
                </td>
            </tr>
        </table>
    </div>
@endif