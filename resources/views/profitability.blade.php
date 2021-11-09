<x-layout>
    <div class="md:w-2/3 w-full mx-auto mt-2">
        <div class="p-2 rounded shadow mb-10">
            <div class="px-2 font-bold">
                Select Profitability Ratio
            </div>
            <form action="{{url()->current()}}" class="flex">
                <select name="prof_ratio" id="" class="p-2 rounded w-10/12 border mx-2">
                    <option value="" {{request()->prof_ratio != ''?:'selected'}} disabled>---</option>
                    <option value="return_on_asssets" {{request()->prof_ratio != 'return_on_asssets'?:'selected'}}>Return on assets</option>
                    <option value="return_on_equity" {{request()->prof_ratio != 'return_on_equity'?:'selected'}}>Return on equity</option>
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
                    <x-return-on-assets-formula></x-return-on-assets-formula>
                    <x-return-on-equity-formula></x-return-on-equity-formula>
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

                </td>
            </tr>
        </table>
    </div>
</x-layout>
