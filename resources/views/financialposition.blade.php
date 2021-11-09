
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>External</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
    <div class="bg-white mx-auto my-5">
        <div class="text-center">
            <h1 class="text-2xl font-bold">
                {{nova_get_setting('company_name')}}
            </h1>
            <h2 class="text-xl font-bold">
                Balance Sheet
            </h2>
            <h3 class="font-bold">
                {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
            </h3>
        </div>
    </div>
    <div class="w-full md:w-1/2 mx-auto">
        <div class="">
            <table class="w-full">
                <tr>
                    <th colspan="2">
                        Assets
                    </th>
                </tr>
                <tr>
                    <td>
                        Current Assets
                    </td>
                    <td>

                    </td>
                </tr>
                @foreach ($assetsCurrentGroups as $key=>$item)
                    <tr>
                        <td class="pl-2">
                            {{$key}}
                        </td>
                        <td>
                            {{abs(\App\Accounting::getTotal($item))}}
                        </td>
                    </tr>
                 @endforeach
                 <tr>
                     <td class="pl-4">
                         Total Current Assets
                     </td>
                     <td class="font-bold">
                         {{$assetsCurrentTotal}}
                     </td>
                 </tr>
                 <th style="color:white">
                     h
                 </th>
                 <tr>
                    <td>
                        Noncurrent Assets
                    </td>
                    <td>

                    </td>
                </tr>
                @foreach ($assetsNonCurrentGroups as $key=>$item)
                <tr>
                    <td class="pl-2">
                        {{$key}}
                    </td>
                    <td>
                        {{abs(\App\Accounting::getTotal($item))}}
                    </td>
                </tr>
                 @endforeach
                 <tr>
                     <td class="pl-4">
                         Total Nonurrent Assets
                     </td>
                     <td class="font-bold">
                         {{abs($assetsNonCurrentTotal)}}
                     </td>
                 </tr>

                 <tr>
                    <td class="font-bold">
                        Total Asset
                    </td>
                    <td  style="width:70px;">
                        <x-total>
                            {{abs($assetsTotal)}}
                        </x-total>
                    </td>

                </tr>

            </table>
            <table class="w-full">
                <tr>
                    <th colspan="2">
                        Liabilities and Capital
                    </th>
                </tr>
                <tr>
                    <td>
                        Current Liabilities
                    </td>
                    <td>

                    </td>
                </tr>
                @foreach ($liabilitiesCurrentGroups as $key=>$item)
                    <tr>
                        <td class="pl-2">
                            {{$key}}
                        </td>
                        <td>
                            {{abs(\App\Accounting::getTotal($item))}}
                        </td>
                    </tr>
                 @endforeach
                 <tr>
                    <td class="pl-4">
                        Total Current Liabilities
                    </td>
                    <td class="font-bold">
                        {{abs($liabilitiesCurrentTotal)}}
                    </td>
                </tr>
                <tr>
                    <td>
                        NonCurrent Liabilities
                    </td>
                    <td>

                    </td>
                </tr>
                @foreach ($liabilitiesNonCurrentGroups as $key=>$item)
                    <tr>
                        <td class="pl-2">
                            {{$key}}
                        </td>
                        <td>
                            {{abs(\App\Accounting::getTotal($item))}}
                        </td>
                    </tr>
                 @endforeach
                 <tr>
                    <td class="pl-4">
                        Total NonCurrent Liabilities
                    </td>
                    <td class="font-bold">
                        {{abs($liabilitiesNonCurrentTotal)}}
                    </td>
                </tr>
                 <tr>
                     <td colspan="2"></td>
                 </tr>
                 <tr>
                    <td colspan="2"></td>
                </tr>
                <tr class="">
                    <td class="font-bold">
                        Capital, ({{\Carbon\Carbon::parse('Y-m-d')}})
                    </td>
                    <td>
                        {{abs($ownerEquity)}}
                    </td>
                 </tr>
                <th style="color:white">
                    h
                </th>
                <tr>
                    <td class="font-bold">
                        Total Liabilities and Equity
                    </td>
                    <td class="" style="width:70px;">
                        <x-total>{{abs($liabilitiesTotal)}}</x-total>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
