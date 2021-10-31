<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Interface</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @page {
            size:A4;
        }
        @media print {
            body, html{
                padding: 0px;
                margin: 0px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-white mx-auto my-5">
        <div class="text-center text-lg">
            <h1 class="font-bold">
                Small and Medium-Sized Enterprises
            </h1>
            <h1 class="font-bold">
                MH Del Pilar St, Tarlac City
            </h1>
            <h1 class="font-bold">
                Daniel Dy - Proprietor
            </h1>
            <div class="text-sm font-bold mt-4">
                FIXED ASSET REGISTER REPORT
            </div>
        </div>
        <div class="w-full mt-4" style="font-size:9px;">
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
        </div>
    </div>

    <script>
        window.onload = function(){
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
</body>
</html>
