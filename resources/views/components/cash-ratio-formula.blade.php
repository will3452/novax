@if (request()->liquidity_ratio == 'cash_ratio')
<div class="border-2  p-2 rounded">
    <table class="text-xl w-full">
        <tr>
            <td rowspan="2">
                Cash Ratio
            </td>
            <td rowspan="2" class="px-2">
                =
            </td>
            <td class="border-b-2 border-black">
                Total Cash
            </td>
        </tr>
        <tr>

            <td>
                Current Liabilities
            </td>
        </tr>
    </table>
</div>
@endif