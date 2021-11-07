

<x-print-layout title="ASSETS REGISTER">
    <table class="w-full">
        <thead>
            <tr>
                <th class="border border-black">
                    Description
                </th>
                <th class="border border-black">
                    Purchase Date
                </th>
                <th class="border border-black">
                    Purchase Cost
                </th>
                <th class="border border-black">
                    Location of Asset
                </th>
                <th class="border border-black">
                    Owner of Asset
                </th>
                <th class="border border-black">
                    User of an Asset
                </th>
                <th class="border border-black">
                    Barcode/Serial Number
                </th>
                <th class="border border-black">
                    Insurance Coverage
                </th>
                <th class="border border-black">
                    Current Value of Asset
                </th>
                <th class="border border-black">
                    Depreciation Method Used
                </th>
                <th class="border border-black">
                    Manufacturer's Warranty
                </th>
                <th class="border border-black">
                    Maintenance Information
                </th>
                <th class="border border-black">
                    Life Expectancy
                </th>
                <th class="border border-black">
                    Estimated Resale Value
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td class="border border-black text-center">
                        {{$asset->description}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->purchase_date->format('m-d-y')}}
                    </td>
                    <td class="border border-black text-center">
                        {{number_format($asset->purchase_cost, 2)}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->location}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->owner}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->users}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->serial_number}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->insurance_coverage}}
                    </td>
                    <td class="border border-black text-center">
                        {{number_format($asset->current_value, 2)}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->depreciation_method_used}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->manufacturers_warranty}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->maintenance_information}}
                    </td>
                    <td class="border border-black text-center">
                        {{$asset->life_expectancy}}
                    </td>
                    <td class="border border-black text-center">
                        {{number_format($asset->estimated_resale_value, 2)}}
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
</x-print-layout>
