
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
                Statement of Owner’s Equity
            </h2>
            <h3 class="font-bold">
                {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
            </h3>
        </div>
    </div>
    <div class="w-full md:w-1/2 mx-auto">
        <table class="w-full">
            <tr>
                <td>
                    {{$capitalName}}
                </td>
                <td tyle="width:200px;">
                    {{$capitalTotal}}
                </td>
            </tr>
            <tr>
                <td>
                    Net {{$net > 0 ? 'Loss' : 'Income'}}
                </td>
                <td tyle="width:200px;">
                    {{$net}}
                </td>
            </tr>
            <tr>
                <td>
                    {{$withdrawalName}}
                </td>
                <td tyle="width:200px;">
                    {{$drawingTotal}}
                </td>
            </tr>
            <tr>
                <td>
                    Capital, {{\Carbon\Carbon::parse($period->end)->format('M d, Y')}}
                </td>
                <td class="underline">
                    {{$capitalTotal + $net + $drawingTotal}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
