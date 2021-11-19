@if (request()->prof_ratio == 'return_on_assets')
<div class="border-2  p-2 rounded">
    <table class="text-xl w-full">
        <tr>
            <td rowspan="2">
                Return On Assets
            </td>
            <td rowspan="2" class="px-2">
                =
            </td>
            <td class="border-b-2 border-black text-center">
                Net Income
            </td>
        </tr>
        <tr>
            <td class="text-center">
                Total Assets
            </td>
        </tr>
    </table>
</div>
@endif
