@if (request()->liquidity_ratio == 'acid_ratio')
<div class="border-2  p-2 rounded">
    <table class="text-xl w-full">
        <tr>
            <td rowspan="2">
                Acid Test Ratio
            </td>
            <td rowspan="2" class="px-2">
                =
            </td>
            <td class="border-b-2 border-black text-center">
                Quck Assets
            </td>
        </tr>
        <tr>

            <td class="text-center">
                Current Liabilities
            </td>
        </tr>
    </table>
</div>
@endif
