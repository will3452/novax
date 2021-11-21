
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
                Trial Balance
            </h2>
            <h3 class="font-bold">
                {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
            </h3>
        </div>
    </div>
    <div class="w-full md:w-1/2 mx-auto">
        <table class="w-full">
            <thead>
                <th class="border border-black px-2">
                    Account
                </th>
                <th class="border border-black px-2">
                    Debit
                </th>
                <th class="border border-black px-2">
                    Credit
                </th>
            </thead>
            <tbody>
                @php
                    $debit = 0;
                    $credit = 0;
                @endphp
                @foreach ($accounts as $key=>$item)
                <tr>
                    <td class="border border-black px-2">
                        {{$key}}
                    </td>
                    @php
                        $value = \App\Accounting::getTotal($item);
                    @endphp
                    @if (\App\Models\Account::getNormalBalance($key) == \App\Models\Account::NORMAL_BALANCE_DEBIT)
                        <td  class="border border-black px-2 text-center">
                            {{abs($value)}}
                            @php
                            $debit += $value;
                        @endphp
                        </td>
                        <td  class="border border-black px-2">

                        </td>
                    @else
                    <td  class="border border-black px-2">

                    </td>
                    <td  class="border border-black px-2 text-center">
                        {{abs($value)}}
                        @php
                            $credit += $value;
                        @endphp
                    </td>
                    @endif
                </tr>
                @endforeach
                <tr class="font-bold">
                    <th class="border border-black px-2">
                        Total
                    </th>
                    <td class="border border-black px-2 text-center">
                        {{abs($debit)}}
                    </td>
                    <td class="border border-black px-2 text-center">
                        {{abs($credit)}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
