
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
                Incoming Statement
            </h2>
            <h3 class="font-bold">
                {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
            </h3>
        </div>
    </div>
    <div class="w-full md:w-1/2 mx-auto">
        <div class="flex">
            <table class="w-full">
                <tr>
                    <th colspan="2">
                        Assets
                    </th>
                </tr>
                @foreach ($assets as $item)
                    <tr>
                        <td>
                            {{$item->account}}
                        </td>
                        <td>
                            {{$item->credit ?? $item->debit}}
                        </td>
                    </tr>
                 @endforeach

            </table>
            <table class="w-full">
                <tr>
                    <th colspan="2">
                        Liabilities and Capital
                    </th>
                </tr>
                @foreach ($liabilities as $item)
                    <tr>
                        <td>
                            {{$item->account}}
                        </td>
                        <td>
                            {{$item->credit ?? $item->debit}}
                        </td>
                    </tr>
                 @endforeach
                 <tr>
                     <td colspan="2"></td>
                 </tr>
                 <tr>
                    <td colspan="2"></td>
                </tr>
                 <tr class="">
                    <td class="font-bold">
                        Owner's Equity
                    </td>
                    <td>
                        {{$ownerEquity}}
                    </td>
                 </tr>
                <tr>

                </tr>
            </table>
        </div>
        <div class="flex">
            <table class="w-1/2">
                <tr>
                    <td class="font-bold">
                        Total Asset
                    </td>
                    <td class="underline" style="width:70px;">
                        {{$assetsTotal}}
                    </td>

                </tr>
            </table>
            <table class="w-1/2">
                <tr>
                    <td class="font-bold">
                        Total Liabilities and Capital
                    </td>
                    <td class="underline" style="width:70px;">
                        {{$liabilitiesTotal}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
