
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
                Income Statement
            </h2>
            <h3 class="font-bold">
                {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
            </h3>
        </div>
    </div>
    <div class="w-full md:w-1/2 mx-auto">

        <table class="w-full">
            <tr>
                <th class="text-left">
                    Revenues
                </th>
            </tr>
            @foreach ($revenues as $item)
            <tr>
                <td class="">
                    {{$item->account}}
                </td >
                <td class="">
                    {{$item->credit ?? $item->debit}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="font-bold " >
                    Total Revenue
                </td>
                <td class="font-bold " style="width:200px;">
                    {{$totalRevenues}}
                </td>
            </tr>
        </table>
        <table class="w-full mt-5">
            <tr>
                <th class="text-left">
                    Expenses
                </th>
            </tr>
            @foreach ($expenses as $item)
            <tr>
                <td class="text-left ">
                    {{$item->account}}
                </td>
                <td class="text-left " style="width:200px;">
                    {{$item->credit ?? $item->debit}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="font-bold text-left">
                    Total Expenses
                </td>
                <td class="font-bold text-left">
                    {{$totalExpenses}}
                </td>
            </tr>
        </table>
        <table class="w-full mt-5">
            <tr>
                <th class="text-left">
                    @if (($totalRevenues - $totalExpenses) < 0)
                        Net Loss
                    @else
                        Net Income
                    @endif
                </th>
                <td class="text-left" style="width:200px;">
                    <x-total>{{$totalRevenues - $totalExpenses}}</x-total>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
