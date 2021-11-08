<x-layout>
    <div class="md:w-2/3 w-full mx-auto mt-2">
        <div class="p-2 rounded shadow mb-10">
            <div class="px-2 font-bold">
                Select Liquidy Ratio
            </div>
            <form action="{{url()->current()}}" class="flex">
                <select name="liquidity_ratio" id="" class="p-2 rounded w-10/12 border mx-2">
                    <option value="" {{request()->liquidity_ratio != ''?:'selected'}} disabled>---</option>
                    <option value="current_ratio" {{request()->liquidity_ratio != 'current_ratio'?:'selected'}}>Current Ratio</option>
                    <option value="acid_ratio" {{request()->liquidity_ratio != 'acid_ratio'?:'selected'}}>Acid Test Ratio</option>
                    <option value="cash_ratio" {{request()->liquidity_ratio != 'cash_ratio'?:'selected'}}>Cash Ratio</option>
                </select>
                <button class="p-2 rounded w-2/12 border bg-green-500 text-white font-bold mx-2">Submit</button>
            </form>
        </div>

        <table class="mt-4 block w-full">
            <tr>
                <td>
                    <x-green-box>
                        FORMULA
                    </x-green-box>
                </td>
                <td class="w-20"></td>
                <td>
                    <x-current-ratio-formula></x-current-ratio-formula>
                    <x-cash-ratio-formula></x-cash-ratio-formula>
                    <x-acid-ratio-formula></x-acid-ratio-formula>
                </td>
            </tr>
            <tr>
                <td>
                    <x-green-box>
                        CALCULATION
                    </x-green-box>
                </td>
                <td class="w-20"></td>
                <td>
                    <x-current-ratio-calculate></x-current-ratio-calculate>
                    <x-cash-ratio-calculate></x-cash-ratio-calculate>
                    <x-acid-ratio-calculate></x-acid-ratio-calculate>
                </td>
            </tr>
            <tr>
                <td>
                    <x-green-box>
                        INTERPRETATION
                    </x-green-box>
                </td>
                <td class="w-20"></td>
                <td>
                    <x-current-ratio-interpret></x-current-ratio-interpret>
                    <x-cash-ratio-interpret></x-cash-ratio-interpret>
                    <x-acid-ratio-interpret></x-acid-ratio-interpret>
                </td>
            </tr>
        </table>
    </div>
</x-layout>
