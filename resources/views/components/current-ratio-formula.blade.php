@if (request()->liquidity_ratio == 'current_ratio')
<div class="border-2  p-2 rounded">
    <table class="text-xl w-full">
        <tr>
            <td rowspan="2">
                Current Ratio
            </td>
            <td rowspan="2" class="px-2">
                =
            </td>
            <td class="border-b-2 border-black">
                Current Assets
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
